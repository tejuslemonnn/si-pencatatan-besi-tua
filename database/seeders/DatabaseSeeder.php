<?php

namespace Database\Seeders;

use App\Models\BarangMasukBesiScrap;
use App\Models\BarangMasukBesiTua;
use App\Models\User;
use App\Models\ITRModel;
use App\Models\Kategori;
use App\Models\DataKapal;
use App\Models\ProductModel;
use App\Models\MaterialModel;
use App\Models\Produk;
use App\Models\StockCountModel;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
            'tanggal' => date('Y-m-d'),
            'bruto' => 19540,
            'tara' => 7460,
            'netto' => 12080,
            'jumlah' => 12080,
            'produk_id' => 1,
        ]);

        BarangMasukBesiTua::create([
            'data_kapal_id' => 1,
            'tanggal' => date('Y-m-d'),
            'bruto' => 23640,
            'tara' => 7500,
            'netto' => 16140,
            'jumlah' => 28220,
            'produk_id' => 1,
        ]);

        BarangMasukBesiScrap::create([
            'data_kapal_id' => 1,
            'produk_id' => 1,
            'tanggal' => date('Y-m-d'),
            'bruto_sb' => 19540,
            'tara_sb' => 7460,
            'netto_sb' => 12080,
            'bruto_pabrik' => 19560,
            'tara_pabrik' => 7500,
            'netto_pabrik' => 12060,
            'pot' => 90,
            'netto_bersih' => 11970,
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
