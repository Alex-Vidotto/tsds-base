<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use Illuminate\Database\Seeder;

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
