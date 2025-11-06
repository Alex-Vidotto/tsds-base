<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\FichaTecnica;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car1 = Car::firstOrCreate([
            'matricula' => 'AR123BC',
            'car_model_id' => 1, // Kangoo
        ]);

        $car2 = Car::firstOrCreate([
            'matricula' => 'AR456DE',
            'car_model_id' => 2, // Partner
        ]);

        $car3 = Car::firstOrCreate([
            'matricula' => 'AR789FG',
            'car_model_id' => 3, // Expert
        ]);

        $car4 = Car::firstOrCreate([
            'matricula' => 'AR321HI',
            'car_model_id' => 1, // Kangoo
        ]);

        // Fichas técnicas
        FichaTecnica::firstOrCreate([
            'car_id' => $car1->id,
        ], [
            'motor' => '1.5 dCi',
            'combustible' => 'Diesel',
            'transmision' => 'Manual',
            'color' => 'Blanco',
            'anio' => 2020,
        ]);

        FichaTecnica::firstOrCreate([
            'car_id' => $car2->id,
        ], [
            'motor' => '1.6 HDi',
            'combustible' => 'Diesel',
            'transmision' => 'Manual',
            'color' => 'Gris',
            'anio' => 2019,
        ]);

        FichaTecnica::firstOrCreate([
            'car_id' => $car3->id,
        ], [
            'motor' => '2.0 BlueHDi',
            'combustible' => 'Diesel',
            'transmision' => 'Automática',
            'color' => 'Negro',
            'anio' => 2021,
        ]);

        FichaTecnica::firstOrCreate([
            'car_id' => $car4->id,
        ], [
            'motor' => '1.5 dCi',
            'combustible' => 'Diesel',
            'transmision' => 'Manual',
            'color' => 'Rojo',
            'anio' => 2018,
        ]);
    }
}
