<?php

namespace App\Http\Controllers;

use App\Models\StockScrap;
use Illuminate\Http\Request;

class StockScrapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = StockScrap::paginate(10);

        return view('admin.stock_scrap.index', [
            'data' => $data,
            'title' => 'Data Stok Scrap',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StockScrap $stockScrap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockScrap $stockScrap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockScrap $stockScrap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockScrap $stockScrap)
    {
        //
    }
}
