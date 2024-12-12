<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $data = Reports::with('warehouse:id,name', 'fromWarehouse:id,name', 'itr')->where(function ($query) {
            $query->where('warehouse_id', auth()->user()->id)
                  ->orWhere('from_warehouse_id', auth()->user()->id);
        })->paginate(10);
        return view('admin/reporting', [
            'data' => $data
        ]);
    }
}
