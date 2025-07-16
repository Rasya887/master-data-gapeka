<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'), // ganti sesuai kebutuhan
            ]
        );

        // Pastikan role Admin ada
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Assign role
        if (!$user->hasRole('Admin')) {
            $user->assignRole('Admin');
        }
    }
}
