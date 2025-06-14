<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $data = History::orderBy('id', 'asc')->paginate(10);

        return view('admin.history.index', [
            'data' => $data,
            'title' => 'Data Riwayat Barang Keluar',
            'icon' => 'fa-solid fa-box'
        ]);
    }
}
