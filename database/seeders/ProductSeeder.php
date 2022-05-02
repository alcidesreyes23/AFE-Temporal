<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        Product::create([
            'id' => 1,
            'product_name' => 'Detergente',
            'price' => 1.25,
            'barcode' => 12345678,
            'supplier_id' => 1,
            'user_id' => 1,
            'image' => 'products-images/' . $this->faker->image('public/storage/products-images',250,100,null,false),
        ]);

        Product::create([
            'id' => 2,
            'product_name' => 'Camisa',
            'price' => 8.50,
            'barcode' => 12658988,
            'supplier_id' => 2,
            'user_id' => 1,
            'image' => 'products-images/' . $this->faker->image('public/storage/products-images',250,100,null,false),
        ]);
    }
}
