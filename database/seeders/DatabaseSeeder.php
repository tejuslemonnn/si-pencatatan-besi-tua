<?php

namespace Database\Seeders;

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
            'name' => 'Central Admin',
            'email' => 'centraladmin@gmail.com',
            'role' => 'admin_pengajuan',
            'password' => '123456'
        ]);
        User::factory()->create([
            'name' => 'Main Storage',
            'email' => 'mainstorage@gmail.com',
            'role' => 'admin_gudang',
            'password' => '123456'
        ]);
        User::factory()->create([
            'name' => 'Sub Storage',
            'email' => 'substorage@gmail.com',
            'role' => 'admin_gudang',
            'password' => '123456'
        ]);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => '123456'
        ]);
        User::factory()->create([
            'name' => 'Kepala Perusahaan',
            'email' => 'kepalaperusahaan@gmail.com',
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
            'nama' => 'Produk Testing',
            'kategori_id' => 1,
            'data_kapal_id' => 1,
            'kode' => 123,
            'nama' => 'Produk Testing',
            'berat' => 123,
            'qty' => 123,
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
