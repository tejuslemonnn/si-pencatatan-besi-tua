<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kendaraan;
use App\Models\Perusahaan;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BarangKeluarBesiScrap;

class BarangKeluarBesiScrapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BarangKeluarBesiScrap::orderBy('id', 'asc')->paginate(10);

        return view('admin.barang_keluar_besi_scrap.index', [
            'data' => $data,
            'title' => 'Data Barang Keluar Besi Scrap',
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

        return view('admin.barang_keluar_besi_scrap.create', [
            'title' => 'Tambah Data Barang Keluar Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'kendaraans' => $kendaraans,
            'suratJalans' => $suratJalans,
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'tanggal' => 'required|date',
            'surat_jalan_id' => 'required|exists:surat_jalans,id',
            'bruto_sb' => 'required|integer',
            'tara_sb' => 'required|integer',
            'netto_sb' => 'required|integer',
            'bruto_pabrik' => 'required|integer',
            'tara_pabrik' => 'required|integer',
            'netto_pabrik' => 'required|integer',
            'pot' => 'required|integer',
            'netto_bersih' => 'required|integer',
            'harga' => 'required|integer',
            'jumlah_harga' => 'required|integer',
            // 'pesanan_dari' => 'required',
            'perusahaan_id' => 'required'
        ]);

        $currentDate = Carbon::now()->format('Y/m/d');
        $request->merge(['kode' => 'BK-BS-' . $currentDate . '-' . $request->kode]);

        $isDuplicate = BarangKeluarBesiScrap::where('kode', $request->kode)->first();
        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Kode sudah digunakan');
        }

        BarangKeluarBesiScrap::create($request->all());

        SuratJalan::where('id', $request->surat_jalan_id)->update([
            'barang_keluar_besi_scrap_id' => BarangKeluarBesiScrap::latest()->first()->id
        ]);

        return redirect()->route('barang-keluar-besi-scrap.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluarBesiScrap $barangKeluarBesiScrap)
    {
        return view('admin.barang_keluar_besi_scrap.show', [
            'title' => 'Detail Data Barang Keluar Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'data' => $barangKeluarBesiScrap
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluarBesiScrap $barangKeluarBesiScrap)
    {
        $kendaraans = Kendaraan::get();
        $suratJalans = SuratJalan::where(function ($query) use ($barangKeluarBesiScrap) {
            $query->where('barang_keluar_besi_scrap_id', $barangKeluarBesiScrap->id)
                ->orWhereNull('barang_keluar_besi_scrap_id');
        })
            ->where(function ($query) {
                $query->whereNull('barang_keluar_besi_tua_id');
            })
            ->get();
        $perusahaans = Perusahaan::get();

        return view('admin.barang_keluar_besi_scrap.edit', [
            'title' => 'Edit Data Barang Keluar Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'data' => $barangKeluarBesiScrap,
            'kendaraans' => $kendaraans,
            'suratJalans' => $suratJalans,
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluarBesiScrap $barangKeluarBesiScrap)
    {
        $request->validate([
            'kode' => 'required',
            'tanggal' => 'required|date',
            'surat_jalan_id' => 'required|exists:surat_jalans,id',
            'bruto_sb' => 'required|integer',
            'tara_sb' => 'required|integer',
            'netto_sb' => 'required|integer',
            'bruto_pabrik' => 'required|integer',
            'tara_pabrik' => 'required|integer',
            'netto_pabrik' => 'required|integer',
            'pot' => 'required|integer',
            'netto_bersih' => 'required|integer',
            'harga' => 'required|integer',
            'jumlah_harga' => 'required|integer',
            // 'pesanan_dari' => 'required'
            'perusahaan_id' => 'required'
        ]);

        $kode = $barangKeluarBesiScrap->kode;
        $kodePrefix = '';
        $kodeSuffix = '';

        // Gunakan regex untuk memisahkan prefix dan suffix
        if (preg_match('/^(.*?)-(\d+)$/', $kode, $matches)) {
            $kodePrefix = $matches[1]; // Ambil bagian sebelum '-'
            $kodeSuffix = $matches[2]; // Ambil angka setelah '-'
        }

        $request->merge(['kode' => $kodePrefix . '-' . $request->kode]);

        SuratJalan::where('id', $barangKeluarBesiScrap->surat_jalan_id)->update([
            'barang_keluar_besi_scrap_id' => null
        ]);

        $barangKeluarBesiScrap->update($request->all());

        SuratJalan::where('id', $request->surat_jalan_id)->update([
            'barang_keluar_besi_scrap_id' => $barangKeluarBesiScrap->id
        ]);


        return redirect()->route('barang-keluar-besi-scrap.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluarBesiScrap $barangKeluarBesiScrap)
    {
        SuratJalan::where('id', $barangKeluarBesiScrap->surat_jalan_id)->update([
            'barang_keluar_besi_scrap_id' => null
        ]);

        $barangKeluarBesiScrap->delete();

        return redirect()->route('barang-keluar-besi-scrap.index')->with('success', 'Data berhasil dihapus');
    }
}
