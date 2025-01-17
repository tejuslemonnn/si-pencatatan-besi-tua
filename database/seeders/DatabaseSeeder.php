<?php

namespace Database\Seeders;

use App\Models\BarangKeluarBesiTua;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Produk;
use App\Models\ITRModel;
use App\Models\Kategori;
use App\Models\DataKapal;
use App\Models\Kendaraan;
use App\Models\SuratJalan;
use App\Models\ProductModel;
use App\Models\MaterialModel;
use App\Models\StockCountModel;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Seeder;
use App\Models\BarangMasukBesiTua;
use App\Models\BarangMasukBesiScrap;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $currentDate = Carbon::now()->format('Y/m/d');
        User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            // 'email' => 'admin@gmail.com',
            'role' => 'admin_perusahaan',
            'password' => '123456'
        ]);
        User::factory()->create([
            'name' => 'Kepala Perusahaan',
            'username' => 'kepala_perusahaan',
            // 'email' => 'kepalaperusahaan@gmail.com',
            'role' => 'kepala_perusahaan',
            'password' => '123456'
        ]);

        DataKapal::create([
            'nama_kapal' => 'KM Mentari Javelin',
            'tanggal_datang' =>  date('Y-m-d'),
        ]);

        Kategori::create([
            'nama' => 'Kategori Testing'
        ]);

        Produk::create([
            'nama' => 'Jatim Steel',
            'kategori_id' => 1,
            'data_kapal_id' => 1,
            'kode' => 123,
            'berat' => 123,
            'qty' => 123,
            'harga' => 7200,
        ]);

        BarangMasukBesiTua::create([
            'data_kapal_id' => 1,
            'kode' => 'BM-BT-' . $currentDate . '-' . '001',
            'tanggal' => date('Y-m-d'),
            'bruto' => 19540,
            'tara' => 7460,
            'netto' => 12080,
            // 'jumlah' => 12080,`
            // 'produk_id' => 1,
            'nama_barang' => 'Besi Tua',
            'pesanan_dari' => 'PT. Jatim Steel',
        ]);

        BarangMasukBesiTua::create([
            'data_kapal_id' => 1,
            'kode' => 'BM-BT-' . $currentDate . '-' . '002',
            'tanggal' => date('Y-m-d'),
            'bruto' => 23640,
            'tara' => 7500,
            'netto' => 16140,
            // 'jumlah' => 28220,
            // 'produk_id' => 1,
            'nama_barang' => 'Jangkar, rantai',
            'pesanan_dari' => 'PT. Jatim Steel',
        ]);

        BarangMasukBesiScrap::create([
            'data_kapal_id' => 1,
            // 'produk_id' => 1,
            'kode' => 'BM-BS-' . $currentDate . '-' . '001',
            'tanggal' => date('Y-m-d'),
            'bruto_sb' => 19540,
            'tara_sb' => 7460,
            'netto_sb' => 12080,
            'bruto_pabrik' => 19560,
            'tara_pabrik' => 7500,
            'netto_pabrik' => 12060,
            'pot' => 90,
            'netto_bersih' => 11970,
            'pesanan_dari' => 'PT. Jatim Steel',

        ]);

        Kendaraan::create([
            'nomor_plat' => 'B 1234 ABC',
            'model' => 'Truk',
        ]);

        SuratJalan::create([
            'no_surat' => 'SJ-' . $currentDate . '-' . '001',
            "tanggal_surat" => "2025-01-16",
            "kendaraan_id" => "1",
            "barang_keluar_besi_tua_id" => null,
            "barang_keluar_besi_scrap_id" => null,
            "penerima" => "Jatim Steel",
            "deskripsi" => null,
        ]);

        SuratJalan::create([
            'no_surat' => 'SJ-' . $currentDate . '-' . '003',
            "tanggal_surat" => "2025-01-16",
            "kendaraan_id" => "1",
            "barang_keluar_besi_tua_id" => null,
            "barang_keluar_besi_scrap_id" => null,
            "penerima" => "Jatim Steel",
            "deskripsi" => null,
            'status' => null,
        ]);

        SuratJalan::create([
            'no_surat' => 'SJ-' . $currentDate . '-' . '002',
            "tanggal_surat" => "2025-01-16",
            "kendaraan_id" => "1",
            "barang_keluar_besi_tua_id" => null,
            "barang_keluar_besi_scrap_id" => null,
            "penerima" => "Jatim Steel",
            "deskripsi" => null,
        ]);

        BarangKeluarBesiTua::create([
            'surat_jalan_id' => 1,
            'kode' => 'BK-BT-' . $currentDate . '-' . '001',
            'tanggal' => date('Y-m-d'),
            'bruto' => 19540,
            'tara' => 7460,
            'netto' => 12080,
            'nama_barang' => 'Besi Tua',
            'kendaraan_id' => 1,
            'harga' => 7200,
            'jumlah_harga' => 7200 * 12080,
            'pesanan_dari' => 'PT. Jatim Steel'
        ]);


        SuratJalan::where('id', 1)->update([
            'barang_keluar_besi_tua_id' => 1
        ]);


        // User::factory()->create([
        //     'name' => 'AdminGudang3',
        //     'email' => 'admingudang3@gmail.com',
        //     'role' => 'admin_gudang',
        //     'password' => '123456'
        // ]);

        // MaterialModel::factory(20)->create();

        // StockCountModel::factory(20)->create();

        // ITRModel::factory(20)->create();

        // ProductModel::factory(20)->create();
    }
}
