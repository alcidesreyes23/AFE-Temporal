<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('products-images');
        Storage::makeDirectory('products-images');
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password =  Hash::make('Admin123');
        $user->remember_token = Str::random(10);
        $user->save();

        $this->call([
            UserSeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class
        ]);
    }
}
