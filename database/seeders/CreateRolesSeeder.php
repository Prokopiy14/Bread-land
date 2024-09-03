<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'User',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::create([
            'name' => 'Customer',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::create([
            'name' => 'Manager',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::create([
            'name' => 'Moderator',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
