<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Events\StockCountEvent;
use App\Models\StockCountModel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailStockCountModel;
use Illuminate\Database\QueryException;
use App\Notifications\StockCountNotification;
use Illuminate\Validation\ValidationException;

class StockCountController extends Controller
{
    public function index()
    {
        return view('admin.stockcount', [
            'title' => 'stock count',
            'active' => 'stock count',
            'data' => auth()->user()->role == "admin_pengajuan"
            ? StockCountModel::with('stockWarehouse')->where(function ($query) {
                $query->where('expired', '>', date("Y-m-d"))
                    ->orWhereNull('expired');
            })->orderBy("created_at", "desc")->paginate(10)
            : StockCountModel::with('stockWarehouse')->where('user_id', auth()->user()->id)
            ->where(function ($query) {
                $query->where('expired', '>', date("Y-m-d"))
                    ->orWhereNull('expired');
            })->orderBy("created_at", "desc")->paginate(10)
        ]);
    }

    public function indexcreate()
    {
        return view('admin.create-stock', [
            'title' => 'stock count',
            'active' => 'stock count',
            'products' => ProductModel::where('user_id', auth()->user()->id)->get(),
            'qty' => ProductModel::where('user_id', auth()->user()->id)->get(),
            'warehouses' => User::where('id', auth()->user()->id)->get()
        ]);
    }

    public function store(Request $req)
    {
        try {
            $validateData = $req->validate([
                "sc_no" => "required|unique:stockcount",
                "inventory" => "required",
                "warehouse" => "required",
                "schedule" => "required",
                "expired" => "required",
                "product.*" => "required",
                "qty.*" => "required",
                "description.*" => "nullable",
                "product_id.*" => "required"
            ]);
            $validateData['status'] = false;
    
            $StockCountData = [
                'sc_no' => "SC-$validateData[sc_no]",
                'user_id' => auth()->user()->id,
                'inventory' => $validateData['inventory'],
                'warehouse' => $validateData['warehouse'],
                'schedule' => $validateData['schedule'],
                'expired' => $validateData['expired'],
                'status' => $validateData['status'],
                ];
    
            if ($req->product == null) {
                return redirect()->back()->with('error', 'Required Item!')->withInput();
            }
    
            $stockcount = StockCountModel::create($StockCountData);
                
     
            if (is_array($req->product) || is_object($req->product)) {
                foreach ($req->product as $key => $detailstockcount) {
                    $DetailStockCountData = [
                        'stockcount_id' => $stockcount->getOriginal()['id'],
                        'product' => $req->product[$key],
                        'qty' => $req->qty[$key],
                        'description' => $req->description[$key],
                    ];
                    DetailStockCountModel::create($DetailStockCountData);
                }
            }
    
            $admins = User::where('role', 'admin_pengajuan')
                         ->get();
    
            $usersource = User::where('id', $stockcount->getOriginal()['user_id'])->first();
    
            foreach ($admins as $key => $admin) {
                $admin->notify(new StockCountNotification($usersource, "Stock Count Required Approve!"));
                event(new StockCountEvent($admin->id, auth()->user()->name, "Stock Count Required Approve!"));
            }
    
            return redirect('/stockcount');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return redirect()->back()->with('error', 'StockCount Number already exists.')->withInput();
            }
            return redirect()->back()->with('error', 'Database error.')->withInput();
        }
    }
    public function destroystockcount($id)
    {
        $stockcount = StockCountModel::find($id);
        $detailstockcount = DetailStockCountModel::where('stockcount_id', $id);

        if ($stockcount) {
            $stockcount->delete();
            $detailstockcount->delete();
        } else {
            // Tangani jika data tidak ditemukan
        }

        return redirect('/stockcount')->with('success', 'Add stock count successfully.');
    }
    public function detailstockcount($id)
    {
        $stockcount = StockCountModel::with('stockWarehouse')->where('id', $id)->with('detailstockcount')->first();
    
        return view('admin/view-stock', [
            'stockcount' => $stockcount
        ]);
    }
    public function edit($id)
    {
        $stockcount = StockCountModel::where('id', $id)->with('detailstockcount', 'stockWarehouse')->first();

        return view('admin/edit-stock', [
            'stockcount' => $stockcount,
            'products' => ProductModel::where('user_id', auth()->user()->id)->get(),
            'qty' => ProductModel::where('user_id', auth()->user()->id)->get(),
        ]);
    }
    public function update($id, Request $req)
    {
        $validateData = $req->validate([
            "inventory" => "required",
            "warehouse" => "required",
            "schedule" => "required",
            "expired" => "required",
            "product.*" => "required",
            "qty.*" => "required",
            "description.*" => "nullable",
            "productId.*" => "required"
        ]);

        
        $StockCountData = [
            'inventory' => $validateData['inventory'],
            'warehouse' => $validateData['warehouse'],
            'schedule' => $validateData['schedule'],
            'expired' => $validateData['expired'],
            ];
        $stockcount = StockCountModel::findOrFail($id);

        if ($req->product == null) {
            return redirect()->back()->with('error', 'Required Item!')->withInput();
        }
 
        DetailStockCountModel::where('stockcount_id', $id)->delete();

        if (is_array($req->product) || is_object($req->product)) {
            foreach ($req->product as $key => $detailstockcount) {
                $DetailStockCountData = [
                    'stockcount_id' => $stockcount->getOriginal()['id'],
                    'product' => $req->product[$key],
                    'qty' => $req->qty[$key],
                    'description' => $req->description[$key],
                ];
                DetailStockCountModel::create($DetailStockCountData);
            }
        }

        $stockcount->update($StockCountData);
        $stockcount->save();
        
        return redirect('/stockcount')->with('success', 'Stock count updated successfully.');
    }

    public function approve($id)
    {
        $stockcount = StockCountModel::with('detailstockcount')->find($id);
        
        foreach ($stockcount->detailstockcount as $detailstockcount) {
            $product = ProductModel::where('id', $detailstockcount->product)->first();
            $product->update([
                'qty' => $product->qty += $detailstockcount->qty
            ]);
            $product->save();
        }

        $stockcount->status = 1;
        $stockcount->expired = null;
        $stockcount->save();

        $usersource = User::where('id', $stockcount->user_id)->first();
        
        $usersource->notify(new StockCountNotification($usersource, "Stock Count"));
        event(new StockCountEvent($usersource->id, $usersource->name, "Stock Count!"));

        return redirect('/stockcount')->with('success', 'Stock count Approved!');
    }

    public function generatepdf($id)
    {
        $stockcount = StockCountModel::find($id);
        $detailstockcount = DetailStockCountModel::where('stockcount_id', $id)->get();
        $data = ['stockcount' => $stockcount, 'detailstockcount' => $detailstockcount];
    
        $pdf = PDF::loadView('admin.stockcount-pdf', $data);
        return $pdf->download('stockcount_' . $stockcount->sc_no . '.pdf');
    }
}
