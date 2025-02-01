<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\DataKapal;
use App\Models\Perusahaan;
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
        $perusahaans = Perusahaan::orderBy('nama', 'ASC')->get();

        return view('admin.barang_masuk_besi_scrap.create', [
            'title' => 'Tambah Data Barang Masuk Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals,
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentDate = Carbon::now()->format('Y/m/d');
        $request->kode = 'BM-BS-' . $currentDate . '-' . $request->kode;

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
            // 'pesanan_dari' => 'required|string',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        $isDuplicate = BarangMasukBesiScrap::where('kode', $request->kode)->exists();

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Kode sudah digunakan');
        }

        BarangMasukBesiScrap::create([
            'kode' => $request->kode,
            'data_kapal_id' => $data['data_kapal_id'],
            'tanggal' => $data['tanggal'],
            'bruto_sb' => $data['bruto_sb'],
            'tara_sb' => $data['tara_sb'],
            'netto_sb' => $data['netto_sb'],
            'bruto_pabrik' => $data['bruto_pabrik'],
            'tara_pabrik' => $data['tara_pabrik'],
            'netto_pabrik' => $data['netto_pabrik'],
            'pot' => $data['pot'],
            'netto_bersih' => $data['netto_bersih'],
            // 'keterangan' => $data['keterangan'],
            // 'pesanan_dari' => $data['pesanan_dari'],
            'perusahaan_id' => $data['perusahaan_id'],
        ]);

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
        $perusahaans = Perusahaan::orderBy('nama', 'ASC')->get();

        return view('admin.barang_masuk_besi_scrap.edit', [
            'data' => $barangMasukBesiScrap,
            'title' => 'Edit Data Barang Masuk Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals,
            'perusahaans' => $perusahaans
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
            // 'pesanan_dari' => 'required|string',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        $data = BarangMasukBesiScrap::findOrFail($barangMasukBesiScrap->id);

        $kode = $data->kode;
        $kodePrefix = '';
        $kodeSuffix = '';

        // Gunakan regex untuk memisahkan prefix dan suffix
        if (preg_match('/^(.*?)-(\d+)$/', $kode, $matches)) {
            $kodePrefix = $matches[1]; // Ambil bagian sebelum '-'
            $kodeSuffix = $matches[2]; // Ambil angka setelah '-'
        }

        $request->kode = $kodePrefix . '-' . $request->kode;

        $isDuplicate = BarangMasukBesiScrap::where('kode', $request->kode)->where('id', '!=', $barangMasukBesiScrap->id)->exists();

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Kode sudah digunakan');
        }

        $barangMasukBesiScrap->update([
            'kode' => $request->kode,
            'data_kapal_id' => $data['data_kapal_id'],
            'tanggal' => $data['tanggal'],
            'bruto_sb' => $data['bruto_sb'],
            'tara_sb' => $data['tara_sb'],
            'netto_sb' => $data['netto_sb'],
            'bruto_pabrik' => $data['bruto_pabrik'],
            'tara_pabrik' => $data['tara_pabrik'],
            'netto_pabrik' => $data['netto_pabrik'],
            'pot' => $data['pot'],
            'netto_bersih' => $data['netto_bersih'],
            // 'pesanan_dari' => $data['pesanan_dari'],
            'perusahaan_id' => $data['perusahaan_id'],
        ]);

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
