<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefaultSeeder extends Seeder
{
    public function run()
    {
        // Admin
        DB::table('users')->insertOrIgnore([
            'id' => 1,
            'role_id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@erp.test',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);

        // Finance
        DB::table('users')->insertOrIgnore([
            'id' => 2,
            'role_id' => 3,
            'name' => 'Keuangan',
            'email' => 'finance@erp.test',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);

        // Kasir
        DB::table('users')->insertOrIgnore([
            'id' => 3,
            'role_id' => 2,
            'name' => 'Kasir 1',
            'email' => 'kasir@erp.test',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);

        // Gudang
        DB::table('users')->insertOrIgnore([
            'id' => 4,
            'role_id' => 4,
            'name' => 'Petugas Gudang',
            'email' => 'gudang@erp.test',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);
    }
}
