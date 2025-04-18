<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\DOEvent;
use App\Models\DOModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\DetailDOModel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\DONotification;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use App\Models\ITRModel;

class DOController extends Controller
{
    public function index(Request $request)
    {

        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $query = auth()->user()->role == "admin_pengajuan"
        ? DOModel::where(function ($query) {
            $query->where('delivery_date', '>', date("Y-m-d"))
                ->orWhereNull('delivery_date');
        })->orderBy("created_at", "desc")
        : DOModel::where('source', auth()->user()->id)
        ->where(function ($query) {
            $query->where('delivery_date', '>', date("Y-m-d"))
                ->orWhereNull('delivery_date');
        })->orderBy("created_at", "desc");

        if ($from_date && $to_date) {
            $query->whereBetween('delivery_date', [$from_date, $to_date]);
        }

        // Paginate the filtered data
        $data = $query->paginate(10);

        return view('admin.DO', [
            'title' => 'delivery order',
            'active' => 'delivery order',

            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get(),
            'data' =>  $data,
        ]);
    }

    public function indexcreate()
    {
        return view('admin.create-DO', [
            'title' => 'create delivery order',
            'active' => 'create delivery order',
            'products' => ProductModel::where('user_id', '=', auth()->user()->id)->get(),
            'source' => User::where('id', '=', auth()->user()->id)->first(),
            'warehouses' => User::where('id', '<>', auth()->user()->id)
                ->where('role', '<>', 'admin_pengajuan')
                ->get(),
            'itr'=> ITRModel::with('itp')->where('source', auth()->user()->id)->where('status', 1)->get(),
        ]);
    }

    public function store(Request $req)
    {
        try {
            $validateData = $req->validate([
                "do_no" => "required|unique:do",
                "source" => "required",
                "destination" => "required",
                "created_date" => "required",
                "delivery_date" => "required",
                "itr_no" => "required",
                "product.*" => "required",
                "product_name.*" => "required",
                "qty.*" => "required",
                "description.*" => "nullable",
            ]);
    
            $validateData['status'] = false;
    
            $DOData = [
                'do_no' => "DO-$validateData[do_no]",
                'source' => $validateData['source'],
                'destination' => $validateData['destination'],
                'created_date' => $validateData['created_date'],
                'delivery_date' => $validateData['delivery_date'],
                "itr_no" => $validateData['itr_no'],
                'status' => $validateData['status'],
            ];
    
            if ($req->product == null) {
                return redirect()->back()->with('error', 'Required Item!')->withInput();
            }
    
            $DO = DOModel::create($DOData);
            if (is_array($req->product) || is_object($req->product)) {
                foreach ($req->product as $key => $DetialDO) {
                    $detailDOData = [
                        'do_id' => $DO->getOriginal()['id'],
                        'product' => $req->product[$key],
                        'product_name' => $req->product_name[$key],
                        'qty' => $req->qty[$key],
                        'description' => $req->description[$key],
                    ];
                    DetailDOModel::create($detailDOData);
                }
            }
    
            $admins = User::where('role', 'admin_pengajuan')
                ->get();
    
    
            $usersource = User::where('id', $DO->getOriginal()['source'])->first();
    
            foreach ($admins as $key => $admin) {
                $admin->notify(new DONotification($usersource, "DO Required Approve!"));
                event(new DOEvent($admin->id, auth()->user()->name, "DO Required Approve!"));
            }
            return redirect('/DO')->with('success', 'DO created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return redirect()->back()->with('error', 'DO Number already exists.')->withInput();
            }
            return redirect()->back()->with('error', 'Database error.')->withInput();
        }
    }

    public function detailDO($id)
    {
        $data = DOModel::where('id', $id)->with('DetailDO', 'sourceWarehouse:id,name', 'destinationWarehouse:id,name')->first();

        return view('admin/view-DO', [
            'data' => $data,
            'warehouses' => User::get(),
            'products' => ProductModel::where('user_id', '<>', auth()->user()->id)->get(),
        ]);
    }
    public function destroyDO($id)
    {
        $do = DOModel::find($id);
        $DetialDO = DetailDOModel::where('do_id', $id);

        if ($do) {
            $do->delete();
            $DetialDO->delete();
        } else {
            // Tangani jika data tidak ditemukan
        }

        return redirect('/DO')->with('success', 'DO deleted successfully.');
    }
    public function edit($id)
    {
        $DO = DOModel::where('id', $id)->with('DetailDO')->first();

        return view('admin.edit-DO', [
            'title' => 'Ubah Delivery Order transfer request',
            'active' => 'Ubah Delivery Order transfer request',
            'data' => $DO,
            'products' => ProductModel::where('user_id', '=', auth()->user()->id)->get(),
            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get(),
            'itr'=> ITRModel::with('itp')->where('source', auth()->user()->id)->where('status', 1)->get(),
        ]);
    }
    public function update($id, Request $req)
    {
        $validateData = $req->validate([
            "do_no" => "required",
            "source" => "required",
            "destination" => "required",
            "itr_no" => "required",
            "created_date" => "required",
            "delivery_date" => "required",
            "product.*" => "required",
            "product_name.*" => "required",
            "qty.*" => "required",
            "description.*" => "nullable",
        ]);

        $validateData['status'] = false;
        $DOData = [
            'do_no' => $validateData['do_no'],
            'source' => $validateData['source'],
            'destination' => $validateData['destination'],
            'itr_no' => $validateData['itr_no'],
            'created_date' => $validateData['created_date'],
            'delivery_date' => $validateData['delivery_date'],
            'status' => $validateData['status'],
        ];

        $DO = DOModel::findOrFail($id);
        if ($req->product == null) {
            return redirect()->back()->with('error', 'Required Item!')->withInput();
        }

        DetailDOModel::where('do_id', $id)->delete();
        if (is_array($req->product) || is_object($req->product)) {
            foreach ($req->product as $key => $DetialDO) {
                $detailDOData = [
                    'do_id' => $DO->getOriginal()['id'],
                    'product' => $req->product[$key],
                    'product_name' => $req->product_name[$key],
                    'qty' => $req->qty[$key],
                    'description' => $req->description[$key],
                ];
                DetailDOModel::create($detailDOData);
            }
        }

        $DO->update($DOData);
        $DO->save();

        return redirect('/DO')->with('success', 'DO updated successfully.');
    }
    public function approve($id)
    {
        $DO = DOModel::findOrFail($id);

        $usersource = User::where('id', $DO->source)->first();
        $userDestination = User::where('id', $DO->destination)->first();

        // warehouse destination notif
        $usersource->notify(new DONotification($usersource, "Delivery Order Request Approved!"));
        event(new DOEvent($usersource->id, $usersource->name, "Delivery Order Request Approved!"));

        // warehouse destination notif
        $userDestination->notify(new DONotification($usersource, "Delivery Order!"));
        event(new DOEvent($userDestination->id, $usersource->name, "Delivery Order!"));

        $DO->update(['status' => 1, 'delivery_date' => null]);

        return redirect('/DO')->with('success', 'DO approved successfully.');
    }
    public function generatepdf($id)
    {
        $DO = DOModel::find($id);
        $DetailDOModel = DetailDOModel::where('do_id', $id)->get();
        // untuk fetch data nama product DetailDOModel
        $productIds = $DetailDOModel->pluck('product')->toArray();
        $products = ProductModel::whereIn('id', $productIds)->get();

        // $products = DetailDOModelModel::where('product',$id)->get();
        // $products = $DetailDOModel->flatMap->pluck('product')->toArray();
        $data = ['DO' => $DO, 'DetailDOModel' => $DetailDOModel, 'products' => $products];

        $pdf = PDF::loadView('admin.DO-pdf', $data);
        return $pdf->download('DO_' . $DO->do_no . '.pdf');
    }
}
