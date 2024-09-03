<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CreateProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++)
        {
            DB::table('products')->insert([
                'title' => Str::random(10),
                'description' => Str::random(30),
                'price' => random_int(20,350),
                'img' => 'images/'.random_int(1,3).'.jpg',
            ]);
        }
    }
}
