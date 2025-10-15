<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarServiceDate;

class CarServiceDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarServiceDate::firstOrCreate([
            'fecha_mantenimiento' => '2024-10-15',
            'car_id' => 1, // referencia al auto
            'car_service_id' => 1 // tipo de mantenimiento que se le hizo
        ]);
    }
}
