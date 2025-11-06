<?php

namespace Database\Seeders;

use App\Models\CarServiceDate;
use Illuminate\Database\Seeder;

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
            'car_id' => 1,
            'car_service_id' => 1, // Mantenimiento preventivo
        ]);

        CarServiceDate::firstOrCreate([
            'fecha_mantenimiento' => '2025-03-10',
            'car_id' => 1,
            'car_service_id' => 2, // Cambio de aceite
        ]);

        CarServiceDate::firstOrCreate([
            'fecha_mantenimiento' => '2024-08-20',
            'car_id' => 2,
            'car_service_id' => 1,
        ]);

        CarServiceDate::firstOrCreate([
            'fecha_mantenimiento' => '2025-01-05',
            'car_id' => 2,
            'car_service_id' => 3, // Revisión general
        ]);

        CarServiceDate::firstOrCreate([
            'fecha_mantenimiento' => '2025-02-18',
            'car_id' => 3,
            'car_service_id' => 2,
        ]);

        CarServiceDate::firstOrCreate([
            'fecha_mantenimiento' => '2024-11-30',
            'car_id' => 4,
            'car_service_id' => 1,
        ]);

        CarServiceDate::firstOrCreate([
            'fecha_mantenimiento' => '2025-04-12',
            'car_id' => 4,
            'car_service_id' => 3,
        ]);
    }
}
