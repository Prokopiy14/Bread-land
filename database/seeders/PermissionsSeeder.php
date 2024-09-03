<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'show products']);
        Permission::create(['name' => 'add products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'destroy products']);
        Permission::create(['name' => 'create organization']);
        Permission::create(['name' => 'edit organization']);
        Permission::create(['name' => 'show orders']);
        Permission::create(['name' => 'edit orders']);
        Permission::create(['name' => 'destroy orders']);
    }
}
