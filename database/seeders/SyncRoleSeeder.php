<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomRole;
use Spatie\Permission\Models\Role;

class SyncRoleSeeder extends Seeder
{
    public function run(): void
    {
        $oldRoles = CustomRole::all();

        foreach ($oldRoles as $r) {
            Role::firstOrCreate(
                ['name' => strtolower($r->name)],
                ['guard_name' => 'web']
            );
        }
    }
}
