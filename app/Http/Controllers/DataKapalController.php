<?php

namespace App\Http\Controllers;

use App\Models\DataKapal;
use Illuminate\Http\Request;

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
        ]);

        DataKapal::create($request->all());

        return redirect()->route('data-kapal.index')->with('success', 'Data Kapal berhasil ditambahkan');
    }
}
