<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DOModel;
use App\Models\ITRModel;
use App\Models\Perusahaan;
use App\Models\ProductModel;
use App\Models\MaterialModel;
use App\Models\StockCountModel;
use App\Models\BarangMasukBesiTua;
use App\Models\BarangKeluarBesiTua;
use App\Http\Controllers\Controller;
use App\Models\BarangMasukBesiScrap;
use App\Models\BarangKeluarBesiScrap;
use App\Models\History;
use App\Models\Produk;

// use Carbon\Carbon;
// use App\Models\DOModel;
// use App\Models\ITRModel;
// use App\Models\ProductModel;
// use Illuminate\Http\Request;
// use App\Models\MaterialModel;
// use App\Models\StockCountModel;

class DashboardController extends Controller
{
    public function index()
    {
        // $materialReqs = MaterialModel::where(function ($query) {
        //     if (auth()->user()->role == "admin_pengajuan") {
        //         $query->where('status', 0);
        //     } else {
        //         $query->where('user_id', auth()->user()->id);
        //     }

        //     $query->where(function ($innerQuery) {
        //         $innerQuery->where('expired', '>', date("Y-m-d"))
        //             ->orWhereNull('expired');
        //     });
        // })->get();


        // $stockCounts = StockCountModel::where(function ($query) {
        //     if (auth()->user()->role == "admin_pengajuan") {
        //         $query->where('status', 0);
        //     } else {
        //         $query->where('user_id', auth()->user()->id);
        //     }

        //     $query->where(function ($innerQuery) {
        //         $innerQuery->where('expired', '>', date("Y-m-d"))
        //             ->orWhereNull('expired');
        //     });
        // })->get();

        // $stockCountsByMonth = $stockCounts->groupBy(function ($item) {
        //     return Carbon::parse($item->created_at)->format('F');
        // });

        // $itrs = ITRModel::where(function ($query) {
        //     if (auth()->user()->role == "admin_pengajuan") {
        //         $query->where('status', 0);
        //     } else {
        //         $query->where('user_id', auth()->user()->id);
        //     }

        //     $query->where(function ($innerQuery) {
        //         $innerQuery->where('expired', '>', date("Y-m-d"))
        //             ->orWhereNull('expired');
        //     });
        // })->get();

        // $ITRsOutByMonth = $itrs->groupBy(function ($item) {
        //     return Carbon::parse($item->created_at)->format('F');
        // });

        // $itrsIn = ITRModel::where(function ($query) {
        //     if (auth()->user()->role == "admin_pengajuan") {
        //         $query->where('status', 0);
        //     } else {
        //         $query->where('user_id', auth()->user()->id);
        //     }

        //     $query->where(function ($innerQuery) {
        //         $innerQuery->where('expired', '>', date("Y-m-d"))
        //             ->orWhereNull('expired');
        //     });
        // })->get();

        // $ITRsInByMonth = $itrsIn->groupBy(function ($item) {
        //     return Carbon::parse($item->created_at)->format('F');
        // });

        // $DOs = DOModel::where(function ($query) {
        //     if (auth()->user()->role == "admin_pengajuan") {
        //         $query->where('status', 0);
        //     } else {
        //         $query->where('source', auth()->user()->id);
        //     }

        //     $query->where(function ($innerQuery) {
        //         $innerQuery->where('delivery_date', '>', date("Y-m-d"))
        //             ->orWhereNull('delivery_date');
        //     });
        // })->get();
        // $products = ProductModel::where('user_id', auth()->user()->id)->get();

        // // Expired Draft
        // $materialReqsExpired = MaterialModel::where('user_id', auth()->user()->id)->whereNotNull('expired')->where('expired', '<=', date("Y-m-d"))->count();

        // $stockCountsExpired = StockCountModel::where('user_id', auth()->user()->id)->where('status', 1)->whereNotNull('expired')->where('expired', '<=', date("Y-m-d"))->count();

        // $itrsExpired = ITRModel::where('source', auth()->user()->id)->where('status', 1)->whereNotNull('expired')->where('expired', '<=', date("Y-m-d"))->count();

        // $DOsExpired = DOModel::where('source', auth()->user()->id)->whereNotNull('delivery_date')->where('delivery_date', '<=', date("Y-m-d"))->count();


        // dd($ITRsOutByMonth,$stockCountsByMonth);

        $barangMasukBesiTuas = BarangMasukBesiTua::where('status', true)->get();
        $barangMasukBesiTuasByMonth = $barangMasukBesiTuas->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('F');
        });

        $barangkeluarBesiTuas = BarangKeluarBesiTua::where('status', true)->get();
        $barangkeluarBesiTuasByMonth = $barangkeluarBesiTuas->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('F');
        });

        $barangMasukBesiScraps = BarangMasukBesiScrap::where('status', true)->get();
        $barangMasukBesiScrapsByMonth = $barangMasukBesiScraps->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('F');
        });

        $barangKeluarBesiScraps = BarangKeluarBesiScrap::where('status', true)->get();
        $barangKeluarBesiScrapsByMonth = $barangKeluarBesiScraps->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('F');
        });

        $perusahaans = Perusahaan::all();
        $produks = Produk::all();

        $historiesAll = History::get();
        $histories = History::orderBy('id', 'asc')->paginate(10);

        return view('admin/dashboard', [
            'title' => 'Dashboard',
            'perusahaans' => $perusahaans,
            'produks' => $produks,
            'barangMasukBesiTuas' => $barangMasukBesiTuas,
            'barangMasukBesiTuasByMonth' => $barangMasukBesiTuasByMonth,
            'barangkeluarBesiTuas' => $barangkeluarBesiTuas,
            'barangkeluarBesiTuasByMonth' => $barangkeluarBesiTuasByMonth,
            'barangMasukBesiScraps' => $barangMasukBesiScraps,
            'barangMasukBesiScrapsByMonth' => $barangMasukBesiScrapsByMonth,
            'barangKeluarBesiScraps' => $barangKeluarBesiScraps,
            'barangKeluarBesiScrapsByMonth' => $barangKeluarBesiScrapsByMonth,
            'historiesAll' => $historiesAll,
            'histories' => $histories,
        ]);
    }
}
