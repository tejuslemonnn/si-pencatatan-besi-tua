<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\DataKapal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BarangMasukBesiScrap;

class BarangMasukBesiScrapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BarangMasukBesiScrap::orderBy('tanggal', 'desc')->paginate(10);

        return view('admin.barang_masuk_besi_scrap.index', [
            'data' => $data,
            'title' => 'Data Barang Masuk Besi Scrap',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Produk::orderBy('nama', 'ASC')->get();
        $dataKapals = DataKapal::orderBy('nama_kapal', 'ASC')->get();

        return view('admin.barang_masuk_besi_scrap.create', [
            'title' => 'Tambah Data Barang Masuk Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals
        ]);
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
    public function show(BarangMasukBesiScrap $barangMasukBesiScrap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasukBesiScrap $barangMasukBesiScrap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasukBesiScrap $barangMasukBesiScrap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasukBesiScrap $barangMasukBesiScrap)
    {
        //
    }
}
