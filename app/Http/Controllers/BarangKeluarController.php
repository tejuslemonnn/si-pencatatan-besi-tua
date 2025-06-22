<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\DataKapal;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\FacadesLog;
use App\Models\BarangKeluarBesiTua;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BarangKeluarBesiScrap;

class BarangKeluarController extends Controller
{
    public function index()
    {
        // $besiTuas = BarangKeluarBesiTua::orderBy('id', 'asc')->paginate(10);
        // $besiScraps = BarangKeluarBesiScrap::orderBy('tanggal', 'desc')->paginate(10);

        $besiTuas = BarangKeluarBesiTua::with(['dataKapal', 'produk', 'perusahaan'])
            ->orderBy('id', 'asc')
            ->paginate(10, ['*'], 'besi_tua_page');

        $besiScraps = BarangKeluarBesiScrap::with(['dataKapal', 'perusahaan'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10, ['*'], 'besi_scrap_page');



        return view('admin.barang_keluar.index', [
            'title' => 'Data Barang Keluar',
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
        $lastEntryBesiTua = BarangKeluarBesiTua::where('kode', 'like', 'BK-BT-' . $currentDate . '-%')
            ->orderBy('kode', 'desc')
            ->first();
        $lastNumberBesiTua = $lastEntryBesiTua ? (int)explode('-', $lastEntryBesiTua->kode)[3] : 0;
        $newNumberBesiTua = str_pad($lastNumberBesiTua + 1, 3, '0', STR_PAD_LEFT);

        $lastEntryBesiScrap = BarangKeluarBesiScrap::where('kode', 'like', 'BK-BS-' . $currentDate . '-%')
            ->orderBy('kode', 'desc')
            ->first();
        $lastNumberBesiScrap = $lastEntryBesiScrap ? (int)explode('-', $lastEntryBesiScrap->kode)[3] : 0;
        $newNumberBesiScrap = str_pad($lastNumberBesiScrap + 1, 3, '0', STR_PAD_LEFT);

        return view('admin.barang_keluar.create', [
            'title' => 'Tambah Data Barang Keluar',
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
        // Determine the form type
        $type = $request->input('type');

        if (!in_array($type, ['besi_tua', 'besi_scrap'])) {
            return redirect()->back()->with('error', 'Tipe form tidak valid');
        }

        // Generate code based on type
        $currentDate = Carbon::now()->format('Y/m/d');
        $prefix = $type === 'besi_tua' ? 'BK-BT-' : 'BK-BS-';
        $fullCode = $prefix . $currentDate . '-' . $request->kode;

        // Check for duplicate codes in both tables
        $isDuplicateBesiTua = BarangKeluarBesiTua::where('kode', $fullCode)->exists();
        $isDuplicateBesiScrap = BarangKeluarBesiScrap::where('kode', $fullCode)->exists();

        if ($isDuplicateBesiTua || $isDuplicateBesiScrap) {
            return redirect()->back()->with('error', 'Kode sudah digunakan')->withInput();
        }

        // Base validation rules
        $baseRules = [
            'type' => 'required|in:besi_tua,besi_scrap',
            'kode' => 'required|string',
            'tanggal' => 'required|date',
            'data_kapal_id' => 'required|exists:data_kapals,id',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ];

        // Type-specific validation rules
        if ($type === 'besi_tua') {
            $specificRules = [
                'produk_id' => 'required|exists:produks,id',
                'bruto' => 'required|numeric|min:0',
                'tara' => 'required|numeric|min:0',
                'netto' => 'required|numeric|min:0',
                'jumlah_harga' => 'required|numeric|min:0',
            ];
        } else { // besi_scrap
            $specificRules = [
                'bruto_sb' => 'required|numeric|min:0',
                'tara_sb' => 'required|numeric|min:0',
                'netto_sb' => 'required|numeric|min:0',
                'bruto_pabrik' => 'required|numeric|min:0',
                'tara_pabrik' => 'required|numeric|min:0',
                'netto_pabrik' => 'required|numeric|min:0',
                'pot' => 'required|numeric|min:0',
                'netto_bersih' => 'required|numeric|min:0',
                'harga' => 'required|numeric|min:0',
                'jumlah_harga' => 'required|numeric|min:0',
            ];
        }

        // Combine validation rules
        $validationRules = array_merge($baseRules, $specificRules);

        // Custom validation messages
        $messages = [
            'required' => 'Field :attribute wajib diisi.',
            'exists' => ':attribute yang dipilih tidak valid.',
            'numeric' => ':attribute harus berupa angka.',
            'min' => ':attribute tidak boleh kurang dari :min.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'in' => ':attribute yang dipilih tidak valid.',
        ];

        // Validate the request
        try {
            $validatedData = $request->validate($validationRules, $messages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Mohon periksa kembali data yang diinput');
        }

        // Prepare data for insertion
        $baseData = [
            'kode' => $fullCode,
            'tanggal' => $validatedData['tanggal'],
            'data_kapal_id' => $validatedData['data_kapal_id'],
            'perusahaan_id' => $validatedData['perusahaan_id'],
            'created_by' => auth()->user()->id,
        ];

        try {
            if ($type === 'besi_tua') {
                // Create Besi Tua record
                $specificData = [
                    'produk_id' => $validatedData['produk_id'],
                    'bruto' => $validatedData['bruto'],
                    'tara' => $validatedData['tara'],
                    'netto' => $validatedData['netto'],
                    'jumlah_harga' => $validatedData['jumlah_harga'],
                ];

                $data = array_merge($baseData, $specificData);
                $record = BarangKeluarBesiTua::create($data);

                // Update product quantity if needed (optional)
                // $this->updateProductQuantity($validatedData['produk_id'], $validatedData['netto'], 'decrease');

                $redirectRoute = 'barang-keluar.index';
                $successMessage = 'Data Barang Keluar Besi Tua berhasil ditambahkan';
            } else { // besi_scrap
                // Create Besi Scrap record
                $specificData = [
                    'bruto_sb' => $validatedData['bruto_sb'],
                    'tara_sb' => $validatedData['tara_sb'],
                    'netto_sb' => $validatedData['netto_sb'],
                    'bruto_pabrik' => $validatedData['bruto_pabrik'],
                    'tara_pabrik' => $validatedData['tara_pabrik'],
                    'netto_pabrik' => $validatedData['netto_pabrik'],
                    'pot' => $validatedData['pot'],
                    'netto_bersih' => $validatedData['netto_bersih'],
                    'harga' => $validatedData['harga'],
                    'jumlah_harga' => $validatedData['jumlah_harga'],
                ];

                $data = array_merge($baseData, $specificData);
                $record = BarangKeluarBesiScrap::create($data);

                $redirectRoute = 'barang-keluar.index';
                $successMessage = 'Data Barang Keluar Besi Scrap berhasil ditambahkan';
            }

            // Log the activity (optional)
            Log::info('Barang Keluar Created', [
                'type' => $type,
                'kode' => $fullCode,
                'user_id' => auth()->user()->id,
                'record_id' => $record->id
            ]);

            return redirect()->route($redirectRoute)->with('success', $successMessage);
        } catch (\Exception $e) {
            Log::error('Error creating Barang Keluar', [
                'type' => $type,
                'error' => $e->getMessage(),
                'user_id' => auth()->user()->id,
                'data' => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }
}
