<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = [
            ['department_name' =>  'Ahuachapán'],
            ['department_name' =>  'Santa Ana'],
            ['department_name' =>  'Sonsonate'],
            ['department_name' =>  'La Libertad'],
            ['department_name' =>  'Chalatenango'],
            ['department_name' =>  'San Salvador'],
            ['department_name' =>  'Cuscatlán'],
            ['department_name' =>  'La Paz'],
            ['department_name' =>  'Cabañas'],
            ['department_name' =>  'San Vicente'],
            ['department_name' =>  'Usulután'],
            ['department_name' =>  'Morazán'],
            ['department_name' =>  'San Miguel'],
            ['department_name' =>  'La Unión'],
        ];
        foreach ($departamentos as $dep) {
            Department::create($dep);
        }
    }
}
