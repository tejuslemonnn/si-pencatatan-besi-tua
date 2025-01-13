<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kendaraan::orderBy('id', 'desc')->paginate(10);

        return view('admin.kendaraan.index', [
            'data' => $data,
            'title' => 'Data Barang Masuk Besi Tua',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kendaraan.create', [
            'title' => 'Tambah Data Kendaraan',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'nomor_plat' => 'required',
            'model' => 'required'
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = Kendaraan::findOrFail($id);

        return view('admin.kendaraan.show', [
            'data' => $data,
            'title' => 'Detail Kendaraan',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = Kendaraan::findOrFail($id);

        return view('admin.kendaraan.edit', [
            'data' => $data,
            'title' => 'Edit Data Kendaraan',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'jenis' => 'required',
            'nomor_plat' => 'required',
            'model' => 'required'
        ]);

        Kendaraan::findOrFail($id)->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Kendaraan::findOrFail($id)->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil dihapus');
    }
}
