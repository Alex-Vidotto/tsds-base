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
        CarBrand::firstOrCreate(['nombre' => 'Renault']);
        CarBrand::firstOrCreate(['nombre' => 'Peugeot']);
        CarBrand::firstOrCreate(['nombre' => 'Hyundai']);
    }
}
