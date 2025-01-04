<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DOModel;
use App\Models\ITRModel;
use App\Models\ExpiredModel;
use Illuminate\Http\Request;
use App\Models\MaterialModel;
use App\Models\StockCountModel;
use Illuminate\Routing\Controller;

class ExpiredController extends Controller
{
    //
    public function expiredMaterial()
    {
        $data = auth()->user()->role == "admin_pengajuan"
        ? MaterialModel::where('expired', '<=', date("Y-m-d"))->orderBy("created_at", "desc")->paginate(10)
        : MaterialModel::where('user_id', auth()->user()->id)->where('expired', '<=', date("Y-m-d"))->orderBy("created_at", "desc")->paginate(10);

        return view('admin.expired-material', [
            'title' => 'Expired Material',
            'active' => 'Expired Material',
            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get(),
            'data' => $data
            ]);
    }

    public function activeMaterial($id, Request $req)
    {
        $material = MaterialModel::findOrFail($id);
        $material->expired = $req->expired;
        $material->save();
        return redirect()->back();
    }

    public function expiredITR()
    {
        $data = auth()->user()->role == "admin_pengajuan"
        ? ITRModel::with('sourceWarehouse:id,name', 'destinationWarehouse:id,name')->where('expired', '<=', date("Y-m-d"))->orderBy("created_at", "desc")->paginate(10)
        : ITRModel::with('sourceWarehouse:id,name', 'destinationWarehouse:id,name')->where('user_id', auth()->user()->id)->where('expired', '<=', date("Y-m-d"))->orderBy("created_at", "desc")->paginate(10);

        return view('admin.expired-itr', [
            'title' => 'Expired ITR',
            'active' => 'Expired ITR',
            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get(),
            'data' => $data
            ]);
    }

    public function activeITR($id, Request $req)
    {
        $itr = ITRModel::findOrFail($id);
        $itr->expired = $req->expired;
        $itr->save();
        return redirect()->back();
    }

    public function expiredStock()
    {
        $data = auth()->user()->role == "admin_pengajuan"
        ? StockCountModel::with('stockWarehouse')->where('expired', '<=', date("Y-m-d"))->orderBy("created_at", "desc")->paginate(10)
        : StockCountModel::with('stockWarehouse')->where('user_id', auth()->user()->id)->where('expired', '<=', date("Y-m-d"))->orderBy("created_at", "desc")->paginate(10);
        return view('admin.expired-stock', [
            'title' => 'Expired stockCount',
            'active' => 'Expired stockCount',
            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get(),
            'data' => $data
            ]);
    }

    public function activeStock($id, Request $req)
    {
        $stock = StockCountModel::findOrFail($id);
        $stock->expired = $req->expired;
        $stock->save();
        return redirect()->back();
    }

    public function expiredDO()
    {
        $data = auth()->user()->role == "admin_pengajuan"
        ? DOModel::where('delivery_date', '<=', date("Y-m-d"))->orderBy("created_date", "desc")->paginate(10)
        : DOModel::where('source', auth()->user()->id)->where('delivery_date', '<=', date("Y-m-d"))->orderBy("created_date", "desc")->paginate(10);
        return view('admin.expired-do', [
            'title' => 'Expired stockCount',
            'active' => 'Expired stockCount',
            'warehouses' => User::where('role', '<>', 'admin_pengajuan')->get(),
            'data' => $data
            ]);
    }

    public function activeDO($id, Request $req)
    {
        $DO = DOModel::findOrFail($id);
        $DO->delivery_date = $req->delivery_date;
        $DO->save();
        return redirect()->back();
    }
}
