<?php

namespace App\Http\Controllers;

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
        return view('admin/dashboard', [
            // 'materialReqs' => $materialReqs,
            // 'itrs' => $itrs,
            // 'stockCounts' => $stockCounts,
            // 'DOs' => $DOs,
            // 'products' => $products,
            // 'stockCountsByMonth' => $stockCountsByMonth,
            // 'ITRsOutByMonth' => $ITRsOutByMonth,
            // 'ITRsInByMonth' => $ITRsInByMonth,
            // 'materialReqsExpired' => $materialReqsExpired,
            // 'stockCountsExpired' => $stockCountsExpired,
            // 'itrsExpired' => $itrsExpired,
            // 'DOsExpired' => $DOsExpired,
        ]);
    }
}
