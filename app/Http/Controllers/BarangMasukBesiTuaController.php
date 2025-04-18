<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DataKapal;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\BarangMasukBesiTua;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BarangMasukBesiTuaController extends Controller
{
    public function index()
    {
        $data = BarangMasukBesiTua::orderBy('id', 'asc')->paginate(10);

        return view('admin.barang_masuk_besi_tua.index', [
            'data' => $data,
            'title' => 'Data Barang Masuk Besi Tua',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function create()
    {
        $products = Produk::orderBy('nama', 'ASC')->get();
        $dataKapals = DataKapal::orderBy('nama_kapal', 'ASC')->get();
        $perusahaans = Perusahaan::orderBy('nama', 'ASC')->get();

        return view('admin.barang_masuk_besi_tua.create', [
            'title' => 'Tambah Data Barang Masuk Besi Tua',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals,
            'perusahaans' => $perusahaans
        ]);
    }

    public function store(Request $request)
    {
        $currentDate = Carbon::now()->format('Y/m/d');
        $request->merge(['kode' => 'BM-BT-' . $currentDate . '-' . $request->kode]);

        $request->validate([
            'tanggal' => 'required|date',
            // 'nopol' => 'required|string|max:255',
            'bruto' => 'required|integer',
            'tara' => 'required|integer',
            'netto' => 'required|integer',
            'data_kapal_id' => 'required|exists:data_kapals,id',
            // 'jumlah' => 'required|integer',
            'produk_id' => 'required|exists:produks,id',
            // 'keterangan' => 'nullable|string|max:255',
            // 'pesanan_dari' => 'required|string',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            // 'nama_barang' => 'required|string',
        ]);

        $isDuplicate = BarangMasukBesiTua::where('kode', $request->kode)->exists();

        if ($isDuplicate) {
            return redirect()->route('barang-masuk-besi-tua.create')->with('error', 'Kode sudah digunakan');
        }

        BarangMasukBesiTua::create([
            'kode' => $request->kode,
            'tanggal' => $request->tanggal,
            // 'nopol' => $request->nopol,
            'bruto' => $request->bruto,
            'tara' => $request->tara,
            'netto' => $request->netto,
            'data_kapal_id' => $request->data_kapal_id,
            'produk_id' => $request->produk_id,
            // 'keterangan' => $request->keterangan,
            // 'pesanan_dari' => $request->pesanan_dari,
            'perusahaan_id' => $request->perusahaan_id,
            // 'nama_barang' => $request->nama_barang,
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        $produk->update([
            'qty' => $produk->qty + $request->netto
        ]);

        return redirect()->route('barang-masuk-besi-tua.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = BarangMasukBesiTua::findOrFail($id);
        $products = Produk::orderBy('nama', 'ASC')->get();
        $dataKapals = DataKapal::orderBy('nama_kapal', 'ASC')->get();
        $perusahaans = Perusahaan::orderBy('nama', 'ASC')->get();

        return view('admin.barang_masuk_besi_tua.edit', [
            'data' => $data,
            'title' => 'Ubah Data Barang Masuk Besi Tua',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals,
            'perusahaans' => $perusahaans
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            // 'nopol' => 'required|string|max:255',
            'bruto' => 'required|integer',
            'tara' => 'required|integer',
            'netto' => 'required|integer',
            // 'jumlah' => 'required|integer',
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'produk_id' => 'required|exists:produks,id',
            // 'keterangan' => 'nullable|string|max:255',
            // 'pesanan_dari' => 'required|string',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            // 'nama_barang' => 'required|string',
        ]);

        $data = BarangMasukBesiTua::findOrFail($id);

        $kode = $data->kode;
        $kodePrefix = '';
        $kodeSuffix = '';

        // Gunakan regex untuk memisahkan prefix dan suffix
        if (preg_match('/^(.*?)-(\d+)$/', $kode, $matches)) {
            $kodePrefix = $matches[1]; // Ambil bagian sebelum '-'
            $kodeSuffix = $matches[2]; // Ambil angka setelah '-'
        }

        $request->merge(['kode' => $kodePrefix . '-' . $request->kode]);

        $isDuplicate = BarangMasukBesiTua::where('kode', $request->kode)->where('id', '!=', $id)->exists();

        if ($isDuplicate) {
            return redirect()->route('barang-masuk-besi-tua.edit', $id)->with('error', 'Kode sudah digunakan');
        }

        $barangMasukBesiTua = BarangMasukBesiTua::findOrFail($id);
        $produk = Produk::findOrFail($request->produk_id);

        $produk->update([
            'qty' => $produk->qty + ($request->netto - $barangMasukBesiTua->netto)
        ]);

        $barangMasukBesiTua->update([
            'kode' => $request->kode,
            'tanggal' => $request->tanggal,
            'bruto' => $request->bruto,
            'tara' => $request->tara,
            'netto' => $request->netto,
            // 'jumlah' => $request->jumlah,
            'data_kapal_id' => $request->data_kapal_id,
            // 'pesanan_dari' => $request->pesanan_dari,
            'perusahaan_id' => $request->perusahaan_id,
            // 'nama_barang' => $request->nama_barang,
            'produk_id' => $request->produk_id,
        ]);



        // $this->recalculateJumlah($barangMasukBesiTua);

        return redirect()->route('barang-masuk-besi-tua.index')->with('success', 'Data berhasil diubah');
    }

    protected function recalculateJumlah(BarangMasukBesiTua $updatedRow)
    {
        $newJumlah = $updatedRow->jumlah;

        $nextDatas = BarangMasukBesiTua::where('id', '>', $updatedRow->id)->orderBy('id', 'asc')->get();

        $currentJumlah = $newJumlah;
        $updates = [];

        foreach ($nextDatas as $nextData) {
            $currentJumlah += $nextData->netto;
            $updates[] = [
                'id' => $nextData->id,
                'jumlah' => $currentJumlah,
                'data_kapal_id' => $nextData->data_kapal_id,
                'tanggal' => $nextData->tanggal,
                'bruto' => $nextData->bruto,
                'tara' => $nextData->tara,
                'netto' => $nextData->netto,
                // 'produk_id' => $nextData->produk_id,
                // 'keterangan' => $nextData->keterangan
                'pesanan_dari' => $nextData->pesanan_dari,
                'nama_barang' => $nextData->nama_barang,
            ];
        }


        // Upsert the updated rows, ensuring all required fields are included
        DB::table('barang_masuk_besi_tuas')->upsert($updates, ['id'], ['jumlah', 'data_kapal_id']);
    }

    public function destroy($id)
    {
        $barangMasukBesiTua = BarangMasukBesiTua::findOrFail($id);
        $barangMasukBesiTua->delete();

        return redirect()->route('barang-masuk-besi-tua.index')->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        $data = BarangMasukBesiTua::findOrFail($id);

        return view('admin.barang_masuk_besi_tua.show', [
            'data' => $data,
            'title' => 'Detail Data Barang Masuk Besi Tua',
            'icon' => 'fa-solid fa-box'
        ]);
    }

    public function getTotalJumlah(Request $request)
    {
        $id = $request->query('id', null); // Access the 'id' query parameter


        $totalJumlah = 0;

        // Query rows up to the specified ID
        $query = BarangMasukBesiTua::query();
        if ($id) {
            $query->where('id', '<', $id); // Calculate only for previous rows
        }

        // Calculate total 'jumlah' for rows
        $query->chunk(100, function ($barangMasukBesiTuas) use (&$totalJumlah) {
            foreach ($barangMasukBesiTuas as $item) {
                $totalJumlah += $item->netto;
            }
        });

        return response()->json([
            'total_jumlah' => $totalJumlah
        ]);
    }

    public function generatepdf($id)
    {
        $barangMasukBesiTua = BarangMasukBesiTua::findOrFail($id);
        $data = ['data' => $barangMasukBesiTua];

        $pdf = PDF::loadView('admin.barang_masuk_besi_tua.pdf', $data);
        return $pdf->download('barang_masuk_besi_tua_' . $barangMasukBesiTua->kode . '.pdf');
    }

    public function approveBarangMasukBesiTua(string $id)
    {
        $data = BarangMasukBesiTua::findOrFail($id);
        $data->update([
            'status' => true,
        ]);

        return redirect()->route('barang-masuk-besi-tua.index')->with('success', 'Data Barang Masuk Besi Tua berhasil disetujui.');
    }

    public function rejectBarangMasukBesiTua(string $id)
    {
        $data = BarangMasukBesiTua::findOrFail($id);
        $data->update([
            'status' => false,
        ]);

        return redirect()->route('barang-masuk-besi-tua.index')->with('success', 'Data Barang Masuk Besi Tua berhasil ditolak.');
    }
}
