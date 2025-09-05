<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarBrand;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarBrand::create(['nombre' => 'Renault']);
        CarBrand::create(['nombre' => 'Peugeot']);
        CarBrand::create(['nombre' => 'Hyundai']);
    }
}
