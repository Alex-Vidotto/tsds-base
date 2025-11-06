<?php

namespace Database\Seeders;

use App\Models\Tarea;
use Illuminate\Database\Seeder;

class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarea::firstOrCreate(['titulo' => 'Conexión']);
        Tarea::firstOrCreate(['titulo' => 'Desconexión']);
        Tarea::firstOrCreate(['titulo' => 'Mantenimiento']);
    }
}
