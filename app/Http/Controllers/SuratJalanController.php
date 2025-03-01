<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kendaraan;
use App\Models\Perusahaan;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\BarangKeluarBesiTua;
use App\Models\BarangKeluarBesiScrap;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisBesi = request()->get('jenis_besi');

        // if ($besiTua === null) {
        //     return redirect()->route('surat-jalan.index', ['besi-tua' => 0]);
        // }

        $data = $jenisBesi === null ? SuratJalan::orderBy('id', 'desc')->paginate(10) : ($jenisBesi == 'besi_tua' ? SuratJalan::whereNotNull('barang_keluar_besi_tua_id')->orderBy('id', 'desc')->paginate(10) : SuratJalan::whereNotNull('barang_keluar_besi_scrap_id')->orderBy('id', 'desc')->paginate(10));

        return view('admin.surat-jalan.index', [
            'data' => $data,
            'title' => 'Data Surat Jalan',
            'icon' => 'fa-solid fa-box',
            'jenisBesi' => $jenisBesi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangKeluarBesiTuas = BarangKeluarBesiTua::all();
        $barangKeluarBesiScraps = BarangKeluarBesiScrap::all();
        $kendaraans = Kendaraan::all();
        $perusahaans = Perusahaan::all();

        return view('admin.surat-jalan.create', [
            'title' => 'Tambah Data Barang Keluar Besi Tua',
            'icon' => 'fa-solid fa-box',
            'barangKeluarBesiTuas' => $barangKeluarBesiTuas,
            'barangKeluarBesiScraps' => $barangKeluarBesiScraps,
            'kendaraans' => $kendaraans,
            'perusahaans' => $perusahaans,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentDate = Carbon::now()->format('Y/m/d');
        $request->no_surat = 'SJ-' . $currentDate . '-' . $request->no_surat;


        $request->validate([
            'tanggal_surat' => 'required|date',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'barang_keluar_besi_tua_id' => 'nullable|exists:barang_keluar_besi_tuas,id',
            'barang_keluar_besi_scrap_id' => 'nullable|exists:barang_keluar_besi_scraps,id',
            // 'penerima' => 'required|string|max:255',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'deskripsi' => 'nullable|string',
        ]);


        $isDuplicate = DB::table('surat_jalans')
            ->where('no_surat', $request->no_surat)
            ->exists();

        if ($isDuplicate) {
            return back()->withErrors(['no_surat' => 'Nomor surat sudah ada.']);
        }


        SuratJalan::create([
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'kendaraan_id' => $request->kendaraan_id,
            'barang_keluar_besi_tua_id' => $request->barang_keluar_besi_tua_id,
            'barang_keluar_besi_scrap_id' => $request->barang_keluar_besi_scrap_id,
            // 'penerima' => $request->penerima,
            'perusahaan_id' => $request->perusahaan_id,
            'deskripsi' => $request->deskripsi,
            'status' => null,
        ]);

        return redirect()->route('surat-jalan.index')->with('success', 'Data Surat Jalan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = SuratJalan::findOrFail($id);

        return view('admin.surat-jalan.show', [
            'data' => $data,
            'title' => 'Detail Surat Jalan',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SuratJalan::findOrFail($id);
        $barangKeluarBesiTuas = BarangKeluarBesiTua::all();
        $barangKeluarBesiScraps = BarangKeluarBesiScrap::all();
        $kendaraans = Kendaraan::all();
        $perusahaans = Perusahaan::all();

        return view('admin.surat-jalan.edit', [
            'data' => $data,
            'title' => 'Edit Data Surat Jalan',
            'icon' => 'fa-solid fa-box',
            'barangKeluarBesiTuas' => $barangKeluarBesiTuas,
            'barangKeluarBesiScraps' => $barangKeluarBesiScraps,
            'kendaraans' => $kendaraans,
            'perusahaans' => $perusahaans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $currentDate = Carbon::now()->format('Y/m/d');


        // dd($request->no_surat);
        // $request->no_surat = 'SJ-' . $currentDate . '-' . $request->no_surat;

        $request->validate([
            'tanggal_surat' => 'required|date',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'barang_keluar_besi_tua_id' => 'nullable|exists:barang_keluar_besi_tuas,id',
            'barang_keluar_besi_scrap_id' => 'nullable|exists:barang_keluar_besi_scraps,id',
            // 'penerima' => 'required|string|max:255',\
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'deskripsi' => 'nullable|string',
        ]);

        $data = SuratJalan::findOrFail($id);

        $noSurat = $data->no_surat;
        $noSuratPrefix = '';
        $noSuratSuffix = '';

        if (preg_match('/^(.*?)-(\d+)$/', $noSurat, $matches)) {
            $noSuratPrefix = $matches[1];
            $noSuratSuffix = $matches[2];
        }

        $newNoSurat = $noSuratPrefix . '-' . $request->no_surat;

        $isDuplicate = DB::table('surat_jalans')
            ->where('no_surat', $newNoSurat)
            ->where('id', '!=', $id) // Abaikan jika ID sama
            ->exists();

        if ($isDuplicate) {
            return back()->withErrors(['no_surat' => 'Nomor surat sudah ada.']);
        }

        $data = SuratJalan::findOrFail($id);

        $data->update([
            'no_surat' => $newNoSurat,
            'tanggal_surat' => $request->tanggal_surat,
            'kendaraan_id' => $request->kendaraan_id,
            'barang_keluar_besi_tua_id' => $request->barang_keluar_besi_tua_id,
            'barang_keluar_besi_scrap_id' => $request->barang_keluar_besi_scrap_id,
            // 'penerima' => $request->penerima,
            'perusahaan_id' => $request->perusahaan_id,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('surat-jalan.index')->with('success', 'Data Surat Jalan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SuratJalan::findOrFail($id);
        $data->delete();

        return redirect()->route('surat-jalan.index')->with('success', 'Data Surat Jalan berhasil dihapus.');
    }

    public function approveSuratJalan(string $id)
    {
        $data = SuratJalan::findOrFail($id);
        $data->update([
            'status' => true,
        ]);

        return redirect()->route('surat-jalan.index')->with('success', 'Data Surat Jalan berhasil disetujui.');
    }

    public function rejectSuratJalan(string $id)
    {
        $data = SuratJalan::findOrFail($id);
        $data->update([
            'status' => false,
        ]);

        return redirect()->route('surat-jalan.index')->with('success', 'Data Surat Jalan berhasil ditolak.');
    }
}
