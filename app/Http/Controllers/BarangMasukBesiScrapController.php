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
        $data = $request->validate([
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'tanggal' => 'required|date',
            'bruto_sb' => 'required|integer',
            'tara_sb' => 'required|integer',
            'netto_sb' => 'required|integer',
            'bruto_pabrik' => 'required|integer',
            'tara_pabrik' => 'required|integer',
            'netto_pabrik' => 'required|integer',
            'pot' => 'required|integer',
            'netto_bersih' => 'required|integer',
            // 'keterangan' => 'nullable|string|max:255',
            'pesanan_dari' => 'required|string',
        ]);

        BarangMasukBesiScrap::create($data);

        return redirect()->route('barang-masuk-besi-scrap.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasukBesiScrap $barangMasukBesiScrap)
    {
        return view('admin.barang_masuk_besi_scrap.show', [
            'title' => 'Detail Data Barang Masuk Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'data' => $barangMasukBesiScrap
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasukBesiScrap $barangMasukBesiScrap)
    {
        $products = Produk::orderBy('nama', 'ASC')->get();
        $dataKapals = DataKapal::orderBy('nama_kapal', 'ASC')->get();

        return view('admin.barang_masuk_besi_scrap.edit', [
            'data' => $barangMasukBesiScrap,
            'title' => 'Edit Data Barang Masuk Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasukBesiScrap $barangMasukBesiScrap)
    {
        $data = $request->validate([
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'tanggal' => 'required|date',
            'bruto_sb' => 'required|integer',
            'tara_sb' => 'required|integer',
            'netto_sb' => 'required|integer',
            'bruto_pabrik' => 'required|integer',
            'tara_pabrik' => 'required|integer',
            'netto_pabrik' => 'required|integer',
            'pot' => 'required|integer',
            'netto_bersih' => 'required|integer',
            'pesanan_dari' => 'required|string',
        ]);

        $barangMasukBesiScrap->update($data);

        return redirect()->route('barang-masuk-besi-scrap.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasukBesiScrap $barangMasukBesiScrap)
    {
        $barangMasukBesiScrap->delete();

        return redirect()->route('barang-masuk-besi-scrap.index')->with('success', 'Data berhasil dihapus');
    }
}
