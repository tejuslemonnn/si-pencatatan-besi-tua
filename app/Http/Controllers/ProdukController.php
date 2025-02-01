<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\DataKapal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::orderBy('id', 'DESC')->paginate(10);

        return view('admin.produk.index', [
            'data' => $data,
            'title' => 'Data Produk',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama', 'ASC')->get();
        $dataKapals = DataKapal::orderBy('nama_kapal', 'ASC')->get();

        return view('admin.produk.create', [
            'kategoris' => $kategoris,
            'dataKapals' => $dataKapals,
            'title' => 'Tambah Data Produk',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            // 'berat' => 'required',
            'qty' => 'nullable',
            // 'kategori_id' => 'required',
            // 'data_kapal_id' => 'required',
            // 'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
        ]);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
        //     $foto->move(public_path('foto_produk'), $namaFoto);
        // } else {
        //     $namaFoto = null;
        // }

        Produk::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            // 'berat' => $request->berat,
            'qty' => $request->qty,
            // 'kategori_id' => $request->kategori_id,
            // 'data_kapal_id' => $request->data_kapal_id,
            // 'picture' => $namaFoto ?? null,
            'harga' => $request->harga,
        ]);

        return redirect()->route('produk.index')->with('success', 'Data Produk berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = Produk::findOrFail($id);

        return view('admin.produk.show', [
            'produk' => $data,
            'title' => 'Detail Data Produk',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function edit($id)
    {
        $data = Produk::findOrFail($id);
        $kategoris = Kategori::orderBy('nama', 'ASC')->get();
        $dataKapals = DataKapal::orderBy('nama_kapal', 'ASC')->get();

        return view('admin.produk.edit', [
            'produk' => $data,
            'kategoris' => $kategoris,
            'dataKapals' => $dataKapals,
            'title' => 'Edit Data Produk',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            // 'berat' => 'required',
            'qty' => 'nullable',
            // 'kategori_id' => 'required',
            // 'data_kapal_id' => 'required',
            // 'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
        ]);

        $data = Produk::findOrFail($id);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('foto_produk'), $namaFoto);
        } else {
            $namaFoto = $data->picture;
        }

        $data->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            // 'berat' => $request->berat,
            'qty' => $request->qty,
            // 'kategori_id' => $request->kategori_id,
            // 'data_kapal_id' => $request->data_kapal_id,
            // 'picture' => $namaFoto ?? null,
            'harga' => $request->harga,
        ]);

        return redirect()->route('produk.index')->with('success', 'Data Produk berhasil diubah');
    }

    public function destroy($id)
    {
        $data = Produk::findOrFail($id);
        $data->delete();

        return redirect()->route('produk.index')->with('success', 'Data Produk berhasil dihapus');
    }
}
