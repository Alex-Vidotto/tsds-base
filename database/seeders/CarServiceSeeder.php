<?php

namespace Database\Seeders;

use App\Models\CarService;
use Illuminate\Database\Seeder;

class CarServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarService::firstOrCreate(['Tipo_servicio' => 'Mantenimiento']);
        CarService::firstOrCreate(['Tipo_servicio' => 'Reparación']);
        CarService::firstOrCreate(['Tipo_servicio' => 'Limpieza']);
        CarService::firstOrCreate(['Tipo_servicio' => 'Cambio de aceite']);
        CarService::firstOrCreate(['Tipo_servicio' => 'Alineación y balanceo']);
        CarService::firstOrCreate(['Tipo_servicio' => 'Revisión de frenos']);
        CarService::firstOrCreate(['Tipo_servicio' => 'Servicio de neumáticos']);
    }
}
