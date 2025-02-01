<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $data = Perusahaan::orderBy('id', 'DESC')->paginate(10);

        return view('admin.perusahaan.index', [
            'data' => $data,
            'title' => 'Data Perusahaan',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function create()
    {
        return view('admin.perusahaan.create', [
            'title' => 'Tambah Data Perusahaan',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Perusahaan::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Data Perusahaan berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = Perusahaan::findOrFail($id);

        return view('admin.perusahaan.show', [
            'data' => $data,
            'title' => 'Detail Data Perusahaan',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function edit($id)
    {
        $data = Perusahaan::findOrFail($id);

        return view('admin.perusahaan.edit', [
            'data' => $data,
            'title' => 'Edit Data Perusahaan',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $data = Perusahaan::findOrFail($id);

        $data->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Data Perusahaan berhasil diubah');
    }

    public function destroy($id)
    {
        $data = Perusahaan::findOrFail($id);
        $data->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Data Perusahaan berhasil dihapus');
    }
}
