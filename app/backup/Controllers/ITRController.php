<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reports;
use App\Events\ITREvent;
use App\Models\ITPModel;
use App\Models\ITRModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\ITRNotification;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class ITRController extends Controller
{
    public function index()
    {

        $query = auth()->user()->role == "admin_pengajuan"
        ? ITRModel::with('sourceWarehouse:id,name', 'destinationWarehouse:id,name')->where(function ($query) {
            $query->where('expired', '>', date("Y-m-d"))
                ->orWhereNull('expired');
        })->orderBy("created_at", "desc")
        : ITRModel::with('sourceWarehouse:id,name', 'destinationWarehouse:id,name')->where('user_id', auth()->user()->id)
        ->where(function ($query) {
            $query->where('expired', '>', date("Y-m-d"))
                ->orWhereNull('expired');
        })->orderBy("created_at", "desc");

        // Paginate the filtered data
        $data = $query->paginate(10);

        return view('admin.ITR', [
            'title' => 'interwarehouse transfer request',
            'active' => 'interwarehouse transfer request',
            'data' => $data,
            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get()
        ]);
    }

    public function ITRIn()
    {
        // Query to fetch data based on the user role and filter parameters
        $query = ITRModel::with('sourceWarehouse:id,name', 'destinationWarehouse:id,name')->where('destination', auth()->user()->id)
        ->where(function ($query) {
            $query->where('expired', '>', date("Y-m-d"))
                ->orWhereNull('expired');
        })->where('status', 1)->orderBy("created_at", "desc");

        // Paginate the filtered data
        $data = $query->paginate(10);

        return view('admin.ITR-in', [
            'title' => 'interwarehouse transfer request',
            'active' => 'interwarehouse transfer request',
            'data' => $data,
            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get()
        ]);
    }

    public function indexcreate()
    {
        return view('admin.create-ITR', [
            'title' => 'create interwarehouse transfer request',
            'active' => 'create interwarehouse transfer request',
            'productsWarehouse' => ProductModel::where('user_id', '=', auth()->user()->id)->where('qty', '>', 0)->get(),
            'products' => ProductModel::where('user_id', '<>', auth()->user()->id)->where('qty', '>', 0)->get(),
            'source' => User::where('id', '=', auth()->user()->id)->first(),
            'warehouses' => User::where('id', '<>', auth()->user()->id)
                ->where('role', '<>', 'admin_pengajuan')
                ->get()
        ]);
    }

    public function store(Request $req)
    {
        try {
            $validateData = $req->validate([
                'itr_no' => 'required|unique:itr',
                "request" => "required",
                "source" => "required",
                "destination" => "required",
                "schedule" => "required",
                "expired" => "required",
                "product.*" => "required",
                "product_name.*" => "required",
                "qty.*" => "required",
                "description.*" => "nullable",
                "current_qty.*" => "required",
                "return_qty.*" => "nullable",
            ]);
    
            $validateData['status'] = false;
    
            $ITRReqData = [
                'itr_no' => "ITR-$validateData[itr_no]",
                'user_id' => auth()->user()->id,
                'request' => $validateData['request'],
                'source' => $validateData['source'],
                'destination' => $validateData['destination'],
                'schedule' => $validateData['schedule'],
                'expired' => $validateData['expired'],
                'status' => $validateData['status'],
            ];
    
            if ($req->product == null) {
                return redirect()->back()->with('error', 'Required Item!')->withInput();
            }
    
            $ITR = ITRModel::create($ITRReqData);
    
            if (is_array($req->product) || is_object($req->product)) {
                foreach ($req->product as $key => $ITP) {
                    $dataITP = [
                        'itr_id' => $ITR->getOriginal()['id'],
                        'product' => $req->product[$key],
                        'product_name' => $req->product_name[$key],
                        'qty' => $req->qty[$key],
                        'description' => $req->description[$key],
                        'current_qty' => $req->current_qty[$key] ?? null,
                        'return_qty' => $req->return_qty[$key] ?? null,
                    ];
                    ITPModel::create($dataITP);
                }
            }
    
            $admins = User::where('role', 'admin_pengajuan')
                ->get();
    
            $usersource = User::where('id', $ITR->getOriginal()['request'])->first();
    
            foreach ($admins as $key => $admin) {
                $admin->notify(new ITRNotification($usersource, "ITR Required Approve!"));
                event(new ITREvent($admin->id, auth()->user()->name, "ITR Required Approve!"));
            }
    
            return redirect('/ITR')->with('success', 'ITR created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return redirect()->back()->with('error', 'ITR Number already exists.')->withInput();
            }
            return redirect()->back()->with('error', 'Database error.')->withInput();
        }
    }

    public function destroyitr($id)
    {
        $itr = ITRModel::find($id);
        $itp = ITPModel::where('itr_id', $id);

        if ($itr) {
            $itr->delete();
            $itp->delete();
        } else {
            // Tangani jika data tidak ditemukan
        }

        return redirect('/ITR')->with('success', 'ITR deleted successfully.');
    }
    public function detailItr($id)
    {
        $detailItr = ITRModel::where('id', $id)->with('ITP', 'sourceWarehouse:id,name', 'requestITr:id,name', 'destinationWarehouse:id,name')->first();

        return view('admin/view-ITR', [
            'detailItr' => $detailItr,
            'warehouses' => User::get(),
            'products' => ProductModel::get(),
        ]);
    }
    public function edit($id)
    {
        $detailItr = ITRModel::where('id', $id)->with('ITP')->first();

        return view('admin.edit-ITR', [
            'title' => 'interwarehouse transfer request',
            'active' => 'interwarehouse transfer request',
            'detailItr' => $detailItr,
            'productsWarehouse' => ProductModel::where('user_id', '=', auth()->user()->id)->where('qty', '>', 0)->get(),
            'products' => ProductModel::where('user_id', '<>', auth()->user()->id)->where('qty', '>', 0)->get(),
            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get()
        ]);
    }
    public function update($id, Request $req)
    {
        $validateData = $req->validate([
            "request" => "required",
            "source" => "required",
            "destination" => "required",
            "schedule" => "required",
            "expired" => "required",
            "product.*" => "required",
            "product_name.*" => "required",
            "qty.*" => "required",
            "description.*" => "nullable",
            "current_qty.*" => "required",
            "return_qty.*" => "nullable",
        ]);

        $ITRReqData = [
            'request' => $validateData['request'],
            'source' => $validateData['source'],
            'destination' => $validateData['destination'],
            'schedule' => $validateData['schedule'],
            'expired' => $validateData['expired'],
        ];

        $ITRModel = ITRModel::findOrFail($id);

        if ($req->product == null) {
            return redirect()->back()->with('error', 'Required Item!')->withInput();
        }

        ITPModel::where('itr_id', $id)->delete();

        if (is_array($req->product) || is_object($req->product)) {
            foreach ($req->product as $key => $ITP) {
                $dataITP = [
                    'itr_id' => $ITRModel->id,
                    'product' => $req->product[$key],
                    'product_name' => $req->product_name[$key],
                    'qty' => $req->qty[$key],
                    'description' => $req->description[$key],
                    'current_qty' => $req->current_qty[$key] ?? null,
                    'return_qty' => $req->return_qty[$key],
                ];
                ITPModel::create($dataITP);
            }
        }

        $ITRModel->update($ITRReqData);
        $ITRModel->save();

        return redirect('/ITR')->with('success', 'ITR updated successfully.');
    }

    public function approve($id)
    {
        $itr = ITRModel::find($id);
        $itp = ITPModel::where('itr_id', $id)->get();
        $idITP = $itp->flatMap->pluck('product')->toArray();

        $productsDestination = ProductModel::whereIn('id', $idITP)->get();
        $productsSource = ProductModel::where('user_id', $itr->user_id)->get();

        foreach ($productsDestination as $productDestination) {
            foreach ($itp as $item) {
                // Check if the item's product matches the current product in $productsDestination
                if ($item->product == $productDestination->id) {
                    // Find the product with the same name in $productsSource
                    $productInSource = $productsSource->firstWhere('name', $item->product_name);

                    // If the product exists in $productsSource, update its quantity
                    if ($productInSource) {
                        // Reduce the return_qty from the product's quantity (if not null)
                        $productInSource->qty -= ($item->return_qty !== null) ? $item->return_qty : 0;
                        // Increase the product's quantity by the qty from $item
                        $productInSource->qty += $item->qty;
                        // Save the changes to the product in $productsSource
                        $productInSource->save();

                        Reports::create([
                            'itr_id' => $itr->id,
                            'product' => $productInSource->id,
                            'warehouse_id' => $itr->source,
                            'from_warehouse_id' => $itr->destination,
                            'product_name' => $productInSource->name,
                            'current_qty' => $productInSource->qty += $item->qty,
                            'in_qty' => $item->qty,
                            'out_qty' => $item->return_qty,
                        ]);
                    }
                    // If the product does not exist in $productsSource, create a new product
                    elseif ($productInSource == null) {
                        ProductModel::create([
                            "user_id" => $itr->user_id,
                            "name" => $productDestination->name,
                            "code" => $productDestination->code,
                            "image" => $productDestination->image,
                            "price" => $productDestination->price,
                            "qty" => $item->qty,
                            "description" => $item->description,
                        ]);

                        Reports::create([
                            'itr_id' => $itr->id,
                            'product' => $productDestination->id,
                            'warehouse_id' => $itr->source,
                            'from_warehouse_id' => $itr->destination,
                            'product_name' => $productDestination->name,
                            'current_qty' => $productDestination->qty += $item->qty,
                            'in_qty' => $item->qty,
                            'out_qty' => $item->return_qty,
                        ]);
                    }

                    // Increase the product's quantity by the return_qty from $item (if not null)
                    $productDestination->qty += ($item->return_qty !== null) ? $item->return_qty : 0;
                    // Reduce the product's quantity by the qty from $item
                    $productDestination->qty -= $item->qty;
                    // Save the changes to the product in $productsDestination
                    $productDestination->save();
                }
            }


            $usersource = User::where('id', $itr->source)->first();
            $userDestination = User::where('id', $itr->destination)->first();

            // warehouse sourcenotif
            $usersource->notify(new ITRNotification($usersource, "ITR Request Approved!"));
            event(new ITREvent($usersource->id, $usersource->name, "ITR Request Approved!"));

            // warehouse destination notif
            $userDestination->notify(new ITRNotification($usersource, "ITR Request!"));
            event(new ITREvent($userDestination->id, $usersource->name, "ITR Request!"));
        }


        // Update ITR status
        $itr->update(['status' => 1, 'expired' => null]);

        return redirect('/ITR')->with('success', 'Approve ITR successfully.');
    }
    public function generatepdf($id)
    {
        $detailItr = ITRModel::find($id);
        $itp = ITPModel::where('itr_id', $id)->get();
        // untuk fetch data nama product itp
        $productIds = $itp->pluck('product')->toArray();
        $products = ProductModel::whereIn('id', $productIds)->get();

        // $products = ITPModel::where('product',$id)->get();
        // $products = $itp->flatMap->pluck('product')->toArray();
        $data = ['detailItr' => $detailItr, 'itp' => $itp, 'products' => $products];

        $pdf = PDF::loadView('admin.ITR-pdf', $data);
        return $pdf->download('ITR_' . $detailItr->itr_no . '.pdf');
    }
}
