<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Kendaraan;
use App\Models\Perusahaan;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\BarangKeluarBesiTua;
use App\Models\DataKapal;

class BarangKeluarBesiTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BarangKeluarBesiTua::orderBy('id', 'asc')->paginate(10);

        return view('admin.barang_keluar_besi_tua.index', [
            'data' => $data,
            'title' => 'Data Barang Keluar Besi Tua',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kendaraans = Kendaraan::get();
        $suratJalans = SuratJalan::WhereNull('barang_keluar_besi_tua_id')->WhereNull('barang_keluar_besi_scrap_id')->get();
        $perusahaans = Perusahaan::get();
        $products = Produk::get();
        $dataKapals = DataKapal::get();

        return view('admin.barang_keluar_besi_tua.create', [
            'title' => 'Tambah Data Barang Keluar Besi Tua',
            'icon' => 'fa-solid fa-box',
            'kendaraans' => $kendaraans,
            'suratJalans' => $suratJalans,
            'perusahaans' => $perusahaans,
            'products' => $products,
            'dataKapals' => $dataKapals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentDate = Carbon::now()->format('Y/m/d');
        $request->kode = 'BK-BT-' . $currentDate . '-' . $request->kode;

        $request->validate([
            'tanggal' => 'required|date',
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'surat_jalan_id' => 'required|exists:surat_jalans,id',
            'bruto' => 'required|integer',
            'tara' => 'required|integer',
            'netto' => 'required|integer',
            // 'harga' => 'required|integer',
            'jumlah_harga' => 'required|integer',
            // 'nama_barang' => 'required|string',
            // 'pesanan_dari' => 'required|string',
            'produk_id' => 'required|exists:produks,id',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        $isDuplicate = BarangKeluarBesiTua::where('kode', $request->kode)->exists();

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Kode sudah digunakan');
        }

        BarangKeluarBesiTua::create([
            'kode' => $request->kode,
            'tanggal' => $request->tanggal,
            'data_kapal_id' => $request->data_kapal_id,
            'surat_jalan_id' => $request->surat_jalan_id,
            'bruto' => $request->bruto,
            'tara' => $request->tara,
            'netto' => $request->netto,
            // 'harga' => $request->harga,
            'jumlah_harga' => $request->jumlah_harga,
            // 'nama_barang' => $request->nama_barang,
            // 'pesanan_dari' => $request->pesanan_dari,
            'produk_id' => $request->produk_id,
            'perusahaan_id' => $request->perusahaan_id,
        ]);

        SuratJalan::where('id', $request->surat_jalan_id)->update([
            'barang_keluar_besi_tua_id' => BarangKeluarBesiTua::latest()->first()->id
        ]);

        return redirect()->route('barang-keluar-besi-tua.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluarBesiTua $barangKeluarBesiTua)
    {
        return view('admin.barang_keluar_besi_tua.show', [
            'title' => 'Detail Data Barang Keluar Besi Tua',
            'icon' => 'fa-solid fa-box',
            'data' => $barangKeluarBesiTua
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluarBesiTua $barangKeluarBesiTua)
    {
        $kendaraans = Kendaraan::get();

        $suratJalans = SuratJalan::where(function ($query) use ($barangKeluarBesiTua) {
            $query->where('barang_keluar_besi_tua_id', $barangKeluarBesiTua->id)
                ->orWhereNull('barang_keluar_besi_tua_id');
        })
            ->where(function ($query) {
                $query->whereNull('barang_keluar_besi_scrap_id');
            })
            ->get();

        $dataKapals = DataKapal::get();

        $perusahaans = Perusahaan::get();

        $products = Produk::get();

        return view('admin.barang_keluar_besi_tua.edit', [
            'title' => 'Edit Data Barang Keluar Besi Tua',
            'icon' => 'fa-solid fa-box',
            'data' => $barangKeluarBesiTua,
            'kendaraans' => $kendaraans,
            'suratJalans' => $suratJalans,
            'perusahaans' => $perusahaans,
            'products' => $products,
            'dataKapals' => $dataKapals
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluarBesiTua $barangKeluarBesiTua)
    {
        $request->validate([
            'tanggal' => 'required|date',
            // 'kendaraan_id' => 'required|exists:kendaraans,id',
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'surat_jalan_id' => 'required|exists:surat_jalans,id',
            'bruto' => 'required|integer',
            'tara' => 'required|integer',
            'netto' => 'required|integer',
            // 'harga' => 'required|integer',
            'jumlah_harga' => 'required|integer',
            // 'nama_barang' => 'required|string',
            'produk_id' => 'required|exists:produks,id',
            // 'pesanan_dari' => 'required|string',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        $kode = $barangKeluarBesiTua->kode;
        $kodePrefix = '';
        $kodeSuffix = '';

        // Gunakan regex untuk memisahkan prefix dan suffix
        if (preg_match('/^(.*?)-(\d+)$/', $kode, $matches)) {
            $kodePrefix = $matches[1]; // Ambil bagian sebelum '-'
            $kodeSuffix = $matches[2]; // Ambil angka setelah '-'
        }

        $request->kode = $kodePrefix . '-' . $request->kode;

        SuratJalan::where('id', $barangKeluarBesiTua->surat_jalan_id)->update([
            'barang_keluar_besi_tua_id' => null
        ]);

        $barangKeluarBesiTua->update([
            'kode' => $request->kode,
            'tanggal' => $request->tanggal,
            // 'kendaraan_id' => $request->kendaraan_id,'
            'data_kapal_id' => $request->data_kapal_id,
            'surat_jalan_id' => $request->surat_jalan_id,
            'bruto' => $request->bruto,
            'tara' => $request->tara,
            'netto' => $request->netto,
            // 'harga' => $request->harga,
            'jumlah_harga' => $request->jumlah_harga,
            // 'nama_barang' => $request->nama_barang,
            'produk_id' => $request->produk_id,
            // 'pesanan_dari' => $request->pesanan_dari,
            'perusahaan_id' => $request->perusahaan_id,
        ]);

        SuratJalan::where('id', $request->surat_jalan_id)->update([
            'barang_keluar_besi_tua_id' => $barangKeluarBesiTua->id
        ]);

        return redirect()->route('barang-keluar-besi-tua.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluarBesiTua $barangKeluarBesiTua)
    {
        SuratJalan::where('id', $barangKeluarBesiTua->surat_jalan_id)->update([
            'barang_keluar_besi_tua_id' => null
        ]);

        $barangKeluarBesiTua->delete();

        return redirect()->route('barang-keluar-besi-tua.index')->with('success', 'Data berhasil dihapus');
    }
}
