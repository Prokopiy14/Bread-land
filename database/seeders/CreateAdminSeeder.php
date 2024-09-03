<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Admin = User::create([
            'email' => 'admin@breadland.com',
            'name' => 'Admin',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::create([
            'name' => 'Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        $Admin->assignRole('Admin');
    }
}
