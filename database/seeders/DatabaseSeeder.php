<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(StudentSeeder::class);

        /*Usuario Admin del Sitio*/
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password =  Hash::make('Admin123');
        $user->save();
    }
}
