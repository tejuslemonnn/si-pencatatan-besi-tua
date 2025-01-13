<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\DataKapal;
use Illuminate\Http\Request;
use App\Models\BarangMasukBesiTua;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BarangMasukBesiTuaController extends Controller
{
    public function index()
    {
        $data = BarangMasukBesiTua::orderBy('id', 'desc')->paginate(10);
        // $data->transform(function ($item, $key) {
        //     $previousData = BarangMasukBesiTua::where('id', '<', $item->id)->orderBy('id', 'desc')->first();
        //     $previousJumlah = $previousData ? $previousData->netto : 0;
        //     $item->jumlah = $item->netto + $previousJumlah;
        //     return $item;
        // });

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

        return view('admin.barang_masuk_besi_tua.create', [
            'title' => 'Tambah Data Barang Masuk Besi Tua',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            // 'nopol' => 'required|string|max:255',
            'bruto' => 'required|integer',
            'tara' => 'required|integer',
            'netto' => 'required|integer',
            'produk_id' => 'required|exists:produks,id',
            'keterangan' => 'nullable|string|max:255',
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'jumlah' => 'required|integer'
        ]);

        BarangMasukBesiTua::create($data);

        return redirect()->route('barang-masuk-besi-tua.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = BarangMasukBesiTua::findOrFail($id);
        $products = Produk::orderBy('nama', 'ASC')->get();
        $dataKapals = DataKapal::orderBy('nama_kapal', 'ASC')->get();

        return view('admin.barang_masuk_besi_tua.edit', [
            'data' => $data,
            'title' => 'Edit Data Barang Masuk Besi Tua',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            // 'nopol' => 'required|string|max:255',
            'bruto' => 'required|integer',
            'tara' => 'required|integer',
            'netto' => 'required|integer',
            'produk_id' => 'required|exists:produks,id',
            'keterangan' => 'nullable|string|max:255',
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'jumlah' => 'required|integer'
        ]);

        $barangMasukBesiTua = BarangMasukBesiTua::findOrFail($id);
        $barangMasukBesiTua->update($data);

        $this->recalculateJumlah($barangMasukBesiTua);

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
                'produk_id' => $nextData->produk_id,
                'keterangan' => $nextData->keterangan
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
}
