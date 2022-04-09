<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'id' => 1,
                'product_name' => 'Detergente',
                'price' => 1.25,
                'barcode' => 12345678,
                'supplier_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'product_name' => 'Camisa',
                'price' => 8.50,
                'barcode' => 12658988,
                'supplier_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
