<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::insert([
            [
                'id' => 1,
                'supplier_name' => 'Unilever',
                'address' => 'San Salvador',
                'phone_number' => '25258987',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'supplier_name' => 'Orange',
                'address' => 'Santa Ana',
                'phone_number' => '27778987',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
