<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarModel;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarModel::create([
            'nombre' => 'Kangoo',
            'car_brand_id' => 1 // Renault
        ]);
        
        CarModel::create([
            'nombre' => 'Partner',
            'car_brand_id' => 2 // Peugeot
        ]);

        CarModel::create([
            'nombre' => 'Expert',
            'car_brand_id' => 2 // Peugeot
        ]);
    }
}
