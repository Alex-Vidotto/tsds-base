<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarService;

class CarServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarService::create(['Tipo_servicio' => 'Mantenimiento']);
        CarService::create(['Tipo_servicio' => 'Reparación']);
        CarService::create(['Tipo_servicio' => 'Limpieza']);
        CarService::create(['Tipo_servicio' => 'Cambio de aceite']);
        CarService::create(['Tipo_servicio' => 'Alineación y balanceo']);
        CarService::create(['Tipo_servicio' => 'Revisión de frenos']);
        CarService::create(['Tipo_servicio' => 'Servicio de neumáticos']);
    }
}
