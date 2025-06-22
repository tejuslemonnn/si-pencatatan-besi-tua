<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\History;
use App\Models\DataKapal;
use App\Models\Kendaraan;
use App\Models\Perusahaan;
use App\Models\StockScrap;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $suratJalans = SuratJalan::whereNull('barang_keluar_besi_tua_id')
            ->whereNull('barang_keluar_besi_scrap_id')
            ->where('status', true)
            ->get();
        $perusahaans = Perusahaan::get();
        $dataKapals = DataKapal::get();

        $currentDate = Carbon::now()->format('Y/m/d');
        $lastEntry = BarangKeluarBesiScrap::where('kode', 'like', 'BK-BS-' . $currentDate . '-%')
            ->orderBy('kode', 'desc')
            ->first();
        $lastNumber = $lastEntry ? (int)explode('-', $lastEntry->kode)[3] : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return view('admin.barang_keluar_besi_scrap.create', [
            'title' => 'Tambah Data Barang Keluar Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'kendaraans' => $kendaraans,
            'suratJalans' => $suratJalans,
            'perusahaans' => $perusahaans,
            'dataKapals' => $dataKapals,
            'newKode' => $newNumber
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
            'data_kapal_id' => 'required|exists:data_kapals,id',
            // 'surat_jalan_id' => 'required|exists:surat_jalans,id',
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

        $request->merge(['created_by' => auth()->user()->id]);

        $BarangKeluarBesiScrap = BarangKeluarBesiScrap::create($request->all());



        // SuratJalan::where('id', $request->surat_jalan_id)->update([
        //     'barang_keluar_besi_scrap_id' => BarangKeluarBesiScrap::latest()->first()->id
        // ]);



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
            ->where('status', true)
            ->get();
        $perusahaans = Perusahaan::get();
        $dataKapals = DataKapal::get();

        return view('admin.barang_keluar_besi_scrap.edit', [
            'title' => 'Ubah Data Barang Keluar Besi Scrap',
            'icon' => 'fa-solid fa-box',
            'data' => $barangKeluarBesiScrap,
            'kendaraans' => $kendaraans,
            'suratJalans' => $suratJalans,
            'perusahaans' => $perusahaans,
            'dataKapals' => $dataKapals
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluarBesiScrap $barangKeluarBesiScrap)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'data_kapal_id' => 'required|exists:data_kapals,id',
            // 'surat_jalan_id' => 'required|exists:surat_jalans,id',
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

        // $kode = $barangKeluarBesiScrap->kode;
        // $kodePrefix = '';
        // $kodeSuffix = '';

        // // Gunakan regex untuk memisahkan prefix dan suffix
        // if (preg_match('/^(.*?)-(\d+)$/', $kode, $matches)) {
        //     $kodePrefix = $matches[1]; // Ambil bagian sebelum '-'
        //     $kodeSuffix = $matches[2]; // Ambil angka setelah '-'
        // }

        // $request->merge(['kode' => $kodePrefix . '-' . $request->kode]);

        // SuratJalan::where('id', $barangKeluarBesiScrap->surat_jalan_id)->update([
        //     'barang_keluar_besi_scrap_id' => null
        // ]);

        $barangKeluarBesiScrap->update([
            'tanggal' => $request->tanggal,
            'data_kapal_id' => $request->data_kapal_id,
            // 'surat_jalan_id' => $request->surat_jalan_id,
            'bruto_sb' => $request->bruto_sb,
            'tara_sb' => $request->tara_sb,
            'netto_sb' => $request->netto_sb,
            'bruto_pabrik' => $request->bruto_pabrik,
            'tara_pabrik' => $request->tara_pabrik,
            'netto_pabrik' => $request->netto_pabrik,
            'pot' => $request->pot,
            'netto_bersih' => $request->netto_bersih,
            'harga' => $request->harga,
            'jumlah_harga' => $request->jumlah_harga,
            // 'pesanan_dari' => $request->pesanan_dari
            'perusahaan_id' => $request->perusahaan_id
        ]);

        // SuratJalan::where('id', $request->surat_jalan_id)->update([
        //     'barang_keluar_besi_scrap_id' => $barangKeluarBesiScrap->id
        // ]);


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

    public function generatepdf($id)
    {
        $barangKeluarBesiScrap = BarangKeluarBesiScrap::findOrFail($id);
        $data = ['data' => $barangKeluarBesiScrap];

        $pdf = PDF::loadView('admin.barang_keluar_besi_scrap.pdf', $data);
        return $pdf->download('barang_keluar_besi_scrap_' . $barangKeluarBesiScrap->kode . '.pdf');
    }

    public function approveBarangKeluarBesiScrap(string $id)
    {
        $data = BarangKeluarBesiScrap::findOrFail($id);
        $stockScrap = StockScrap::findOrFail(1);

        if (
            $stockScrap->netto_total < $data->netto_bersih ||
            $stockScrap->sb_total < $data->netto_sb ||
            $stockScrap->pabrik_total < $data->netto_pabrik
        ) {
            return redirect()->route('barang-keluar-besi-scrap.index')->with('error', 'Stock tidak mencukupi untuk barang keluar.');
        }

        $data->update([
            'status' => true,
        ]);

        History::create([
            'created_by' => $data->created_by,
            'barang_keluar_besi_scraps' => $data->id
        ]);

        $stockScrap->decrement('netto_total', $data->netto_bersih);
        $stockScrap->decrement('sb_total', $data->netto_sb);
        $stockScrap->decrement('pabrik_total', $data->netto_pabrik);

        return redirect()->route('barang-keluar-besi-scrap.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function rejectBarangKeluarBesiScrap(string $id)
    {
        $data = BarangKeluarBesiScrap::findOrFail($id);
        $data->update([
            'status' => false,
        ]);

        return redirect()->route('barang-keluar-besi-scrap.index')->with('success', 'Data Barang Keluar Besi Scrap berhasil ditolak.');
    }
}
