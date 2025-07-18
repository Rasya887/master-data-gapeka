<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['name' => 'Dashboard', 'url' => '/dashboard', 'icon' => 'fas fa-tachometer-alt', 'order' => 1, 'is_active' => true],
            ['name' => 'Manajemen User', 'url' => '/users', 'icon' => 'fas fa-users', 'order' => 2, 'is_active' => true],
            ['name' => 'Manajemen Role', 'url' => '/roles', 'icon' => 'fas fa-user-shield', 'order' => 3, 'is_active' => true],
            ['name' => 'Manajemen Menu', 'url' => '/menus', 'icon' => 'fas fa-bars', 'order' => 4, 'is_active' => true],
        ];

        foreach ($menus as $menu) {
            Menu::firstOrCreate(['name' => $menu['name']], $menu);
        }
    }
}
