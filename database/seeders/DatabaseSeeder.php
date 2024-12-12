<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ITRModel;
use App\Models\ProductModel;
use App\Models\MaterialModel;
use App\Models\StockCountModel;
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
