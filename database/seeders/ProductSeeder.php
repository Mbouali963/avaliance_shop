<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name' => "Pong", 'category_id' => 2, 'sku' => "A0001", 'price' => 69.99, 'quantity' => 20],
            ['name' => "GameStation 5", 'category_id' => 2, 'sku' => "A0002", 'price' => 269.99, 'quantity' => 15],
            ['name' => "AP Oman PC - Aluminum", 'category_id' => 1, 'sku' => "A0003", 'price' => 1399.99, 'quantity' => 10],
            ['name' => "Fony UHD HDR 55\" 4k TV", 'category_id' => 3, 'sku' => "A0004", 'price' => 1399.99, 'quantity' => 5],
        ]);
    }
}
