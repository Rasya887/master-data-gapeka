<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignRolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'Admin')->first();
        $editor = Role::where('name', 'Editor')->first();
        $user = Role::where('name', 'User')->first();

        // Admin dapat semua permission
        $admin->syncPermissions(Permission::all());

        // Editor bisa akses menu tertentu
        $editor->syncPermissions([
            'manage menus',
            'view dashboard',
        ]);

        // User hanya bisa lihat dashboard
        $user->syncPermissions(['view dashboard']);

        $this->command->info('Permissions assigned to roles.');
    }
}

