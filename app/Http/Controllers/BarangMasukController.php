<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\DataKapal;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\BarangMasukBesiTua;
use App\Http\Controllers\Controller;
use App\Models\BarangMasukBesiScrap;

class BarangMasukController extends Controller
{
    public function index()
    {
        // $besiTuas = BarangMasukBesiTua::orderBy('id', 'asc')->paginate(10);
        // $besiScraps = BarangMasukBesiScrap::orderBy('tanggal', 'desc')->paginate(10);

        $besiTuas = BarangMasukBesiTua::with(['dataKapal', 'produk', 'perusahaan'])
            ->orderBy('id', 'asc')
            ->paginate(10, ['*'], 'besi_tua_page');

        $besiScraps = BarangMasukBesiScrap::with(['dataKapal', 'perusahaan'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10, ['*'], 'besi_scrap_page');



        return view('admin.barang_masuk.index', [
            'title' => 'Data Barang Masuk',
            'icon' => 'fa-solid fa-box',
            'besiTuas' => $besiTuas,
            'besiScraps' => $besiScraps
        ]);
    }

    public function create()
    {
        $products = Produk::orderBy('nama', 'ASC')->get();
        $dataKapals = DataKapal::orderBy('nama_kapal', 'ASC')->get();
        $perusahaans = Perusahaan::orderBy('nama', 'ASC')->get();

        $currentDate = Carbon::now()->format('Y/m/d');
        $lastEntryBesiTua = BarangMasukBesiTua::where('kode', 'like', 'BM-BT-' . $currentDate . '-%')
            ->orderBy('kode', 'desc')
            ->first();
        $lastNumberBesiTua = $lastEntryBesiTua ? (int)explode('-', $lastEntryBesiTua->kode)[3] : 0;
        $newNumberBesiTua = str_pad($lastNumberBesiTua + 1, 3, '0', STR_PAD_LEFT);

        $lastEntryBesiScrap = BarangMasukBesiScrap::where('kode', 'like', 'BM-BS-' . $currentDate . '-%')
            ->orderBy('kode', 'desc')
            ->first();
        $lastNumberBesiScrap = $lastEntryBesiScrap ? (int)explode('-', $lastEntryBesiScrap->kode)[3] : 0;
        $newNumberBesiScrap = str_pad($lastNumberBesiScrap + 1, 3, '0', STR_PAD_LEFT);

        return view('admin.barang_masuk.create', [
            'title' => 'Tambah Data Barang Masuk',
            'icon' => 'fa-solid fa-box',
            'products' => $products,
            'dataKapals' => $dataKapals,
            'perusahaans' => $perusahaans,
            'newKodeBesiTua' => $newNumberBesiTua,
            'newKodeBesiScrap' => $newNumberBesiScrap
        ]);
    }

    public function store(Request $request)
    {
        // Determine the type based on the form submission
        $type = $request->input('type'); // We'll add this as a hidden field in the form

        if (!in_array($type, ['besi_tua', 'besi_scrap'])) {
            return redirect()->back()->with('error', 'Invalid form type');
        }

        $currentDate = Carbon::now()->format('Y/m/d');

        // Generate appropriate code based on type
        if ($type === 'besi_tua') {
            $prefix = 'BM-BT-';
            $lastEntry = BarangMasukBesiTua::where('kode', 'like', $prefix . $currentDate . '-%')
                ->orderBy('kode', 'desc')
                ->first();
        } else {
            $prefix = 'BM-BS-';
            $lastEntry = BarangMasukBesiScrap::where('kode', 'like', $prefix . $currentDate . '-%')
                ->orderBy('kode', 'desc')
                ->first();
        }

        $lastNumber = $lastEntry ? (int)explode('-', $lastEntry->kode)[3] : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $newCode = $prefix . $currentDate . '-' . $newNumber;

        // Add the generated code to the request
        $request->merge(['kode' => $newCode]);

        // Define validation rules based on type
        $commonRules = [
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'tanggal' => 'required|date',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ];

        if ($type === 'besi_tua') {
            $validationRules = array_merge($commonRules, [
                'produk_id' => 'required|exists:produks,id',
                'bruto' => 'required|numeric|min:0',
                'tara' => 'required|numeric|min:0',
                'netto' => 'required|numeric|min:0',
            ]);
        } else {
            $validationRules = array_merge($commonRules, [
                'bruto_sb' => 'required|numeric|min:0',
                'tara_sb' => 'required|numeric|min:0',
                'netto_sb' => 'required|numeric|min:0',
                'bruto_pabrik' => 'required|numeric|min:0',
                'tara_pabrik' => 'required|numeric|min:0',
                'netto_pabrik' => 'required|numeric|min:0',
                'pot' => 'required|numeric|min:0',
                'netto_bersih' => 'required|numeric|min:0',
            ]);
        }

        // Validate the request
        $validatedData = $request->validate($validationRules);

        // Check for duplicate codes
        if ($type === 'besi_tua') {
            $isDuplicate = BarangMasukBesiTua::where('kode', $newCode)->exists();
        } else {
            $isDuplicate = BarangMasukBesiScrap::where('kode', $newCode)->exists();
        }

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Kode sudah digunakan')->withInput();
        }

        try {
            // Create the record based on type
            if ($type === 'besi_tua') {
                $record = BarangMasukBesiTua::create([
                    'kode' => $newCode,
                    'tanggal' => $validatedData['tanggal'],
                    'bruto' => $validatedData['bruto'],
                    'tara' => $validatedData['tara'],
                    'netto' => $validatedData['netto'],
                    'data_kapal_id' => $validatedData['data_kapal_id'],
                    'produk_id' => $validatedData['produk_id'],
                    'perusahaan_id' => $validatedData['perusahaan_id'],
                ]);

                // Update product quantity for Besi Tua
                $produk = Produk::findOrFail($validatedData['produk_id']);
                $produk->update([
                    'qty' => $produk->qty + $validatedData['netto']
                ]);

                $successMessage = 'Data Besi Tua berhasil ditambahkan';
                $redirectRoute = 'barang-masuk.index'; // Redirect to unified index

            } else {
                $record = BarangMasukBesiScrap::create([
                    'kode' => $newCode,
                    'data_kapal_id' => $validatedData['data_kapal_id'],
                    'tanggal' => $validatedData['tanggal'],
                    'bruto_sb' => $validatedData['bruto_sb'],
                    'tara_sb' => $validatedData['tara_sb'],
                    'netto_sb' => $validatedData['netto_sb'],
                    'bruto_pabrik' => $validatedData['bruto_pabrik'],
                    'tara_pabrik' => $validatedData['tara_pabrik'],
                    'netto_pabrik' => $validatedData['netto_pabrik'],
                    'pot' => $validatedData['pot'],
                    'netto_bersih' => $validatedData['netto_bersih'],
                    'perusahaan_id' => $validatedData['perusahaan_id'],
                ]);

                $successMessage = 'Data Besi Scrap berhasil ditambahkan';
                $redirectRoute = 'barang-masuk.index'; // Redirect to unified index
            }

            return redirect()->route($redirectRoute)->with('success', $successMessage);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
