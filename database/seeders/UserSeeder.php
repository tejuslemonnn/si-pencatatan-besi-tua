<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'AdminGudang1',
        //     'email' => 'admingudang1@gmail.com',
        //     'role' => 'admin_gudang',
        //     'password' => '123456'
        // ]);
        // User::factory()->create([
        //     'name' => 'AdminGudang2',
        //     'email' => 'admingudang2@gmail.com',
        //     'role' => 'admin_gudang',
        //     'password' => '123456'
        // ]);
    //     User::factory()->create([
    //         'name' => 'AdminGudang3',
    //         'email' => 'admingudang3@gmail.com',
    //         'role' => 'admin_gudang',
    //         'password' => '123456'
    //     ]);
    // }

    User::factory()->create([
        'nama' => 'admin_perusahaan1',
        'username' => 'adminperusahaan1',
        'role' => 'admin_perusahaan',
        'password' => 'admin1'
    ]);

    }
}