<?php

namespace App\Http\Controllers;

use App\Models\DataKapal;
use Illuminate\Http\Request;
use App\Models\BarangMasukBesiTua;
use App\Models\BarangKeluarBesiTua;
use App\Http\Controllers\Controller;
use App\Models\BarangMasukBesiScrap;
use App\Models\BarangKeluarBesiScrap;

class DataKapalController extends Controller
{
    public function index()
    {
        $data = DataKapal::orderBy('id', 'desc')->paginate(10);
        $title = 'Data Kapal';
        $icon = 'fa-solid fa-ship';

        return view('admin.data-kapal.index', [
            'title' => $title,
            'icon' => $icon,
            'data' => $data,
        ]);
    }

    public function create()
    {
        $title = 'Tambah Data Kapal';
        $icon = 'fa-solid fa-ship';

        return view('admin.data-kapal.create', [
            'title' => $title,
            'icon' => $icon,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kapal' => 'required',
            'tanggal_datang' => 'required',
            // 'total_modal' => 'required|integer|min:0',
        ]);

        DataKapal::create($request->all());

        return redirect()->route('data-kapal.index')->with('success', 'Data Kapal berhasil ditambahkan');
    }

    public function show($id)
    {
        $title = 'Detail Data Kapal';
        $icon = 'fa-solid fa-ship';
        $dataKapal = DataKapal::findOrFail($id);

        $barangMasukBesiTua = BarangMasukBesiTua::where('data_kapal_id', $id)->orderBy('id', 'DESC')->paginate(10);
        $barangMasukBesiScrap = BarangMasukBesiScrap::where('data_kapal_id', $id)->orderBy('id', 'DESC')->paginate(10);

        return view('admin.data-kapal.show', [
            'title' => $title,
            'icon' => $icon,
            'dataKapal' => $dataKapal,
            'barangMasukBesiTua' => $barangMasukBesiTua,
            'barangMasukBesiScrap' => $barangMasukBesiScrap,
        ]);
    }

    public function edit($id)
    {
        $title = 'Ubah Data Kapal';
        $icon = 'fa-solid fa-ship';
        $dataKapal = DataKapal::findOrFail($id);

        return view('admin.data-kapal.edit', [
            'title' => $title,
            'icon' => $icon,
            'dataKapal' => $dataKapal,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kapal' => 'required',
            'tanggal_datang' => 'required',
            'total_modal' => 'required|integer|min:0',
        ]);

        DataKapal::findOrFail($id)->update($request->all());

        return redirect()->route('data-kapal.index')->with('success', 'Data Kapal berhasil diubah');
    }

    public function destroy($id)
    {
        DataKapal::findOrFail($id)->delete();

        return redirect()->route('data-kapal.index')->with('success', 'Data Kapal berhasil dihapus');
    }

    public function rekapan($id)
    {
        $title = 'Rekapan Data Kapal';
        $icon = 'fa-solid fa-ship';
        $data = DataKapal::findOrFail($id);
        $keseluruhanBesiTuaKapal = BarangMasukBesiTua::where('data_kapal_id', $id)->sum('netto');
        $keseluruhanBesiScrapKapal = BarangMasukBesiScrap::where('data_kapal_id', $id)->sum('netto_bersih');
        $keseluruhanBesiKapal = $keseluruhanBesiTuaKapal + $keseluruhanBesiScrapKapal;
        $totalPenjualanBesiTuaKapal = BarangKeluarBesiTua::where('data_kapal_id', $id)->sum('jumlah_harga');
        $totalPenjualanBesiScrapKapal = BarangKeluarBesiScrap::where('data_kapal_id', $id)->sum('jumlah_harga');
        $totalPenjualanKapal = $totalPenjualanBesiTuaKapal + $totalPenjualanBesiScrapKapal;
        // dd($keseluruhanBesiTuaKapal, $keseluruhanBesiScrapKapal, $keseluruhanBesiKapal);

        // $barangKeluarBesiTua = BarangKeluarBesiTua::where('data_kapal_id', $id)->pluck('netto', 'jumlah_harga');
        // dd($barangKeluarBesiTua);

        return view('admin.data-kapal.rekapan', [
            'title' => $title,
            'icon' => $icon,
            'dataKapal' => $data,
            'keseluruhanBesiKapal' => $keseluruhanBesiKapal,
            'totalPenjualanKapal' => $totalPenjualanKapal,
        ]);
    }
}
