<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        car::firstOrCreate([
            'matricula' => 'AR123BC',
            'car_model_id' => 1 // Kangoo
        ]);

        car::firstOrCreate([
            'matricula' => 'AR456DE',
            'car_model_id' => 2 // Partner
        ]);

        car::firstOrCreate([
            'matricula' => 'AR789FG',
            'car_model_id' => 3 // Expert
        ]);

        car::firstOrCreate([
            'matricula' => 'AR321HI',
            'car_model_id' => 1 // Kangoo
        ]);
    }
}
