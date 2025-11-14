<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus cache permission dulu biar gak error
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ==== ROLE ====
        $roles = ['admin', 'finance', 'gudang', 'kasir'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // ==== PERMISSIONS (Optional, bisa diatur sesuai kebutuhan) ====
        $permissions = [
            'view dashboard',
            'manage users',
            'manage finance',
            'manage warehouse',
            'manage sales'
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Assign permission ke role sesuai tanggung jawabnya
        Role::where('name', 'admin')->first()->syncPermissions(Permission::all());
        Role::where('name', 'finance')->first()->syncPermissions(['manage finance']);
        Role::where('name', 'gudang')->first()->syncPermissions(['manage warehouse']);
        Role::where('name', 'kasir')->first()->syncPermissions(['manage sales']);

        // ==== USER ADMIN DEFAULT ====
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
                'status' => 'aktif',
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('admin');

        $this->command->info('✅ Seeder sukses! Role, permission, dan akun admin sudah dibuat.');
        $this->command->warn('Login pakai:');
        $this->command->line('Email: admin@example.com');
        $this->command->line('Password: admin12345');
    }
}
