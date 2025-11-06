<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\GrupoTrabajo;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Database\Seeder;

class GrupoTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buscar auto libre
        $auto = Car::whereDoesntHave('grupoTrabajo')->first();

        // Buscar usuario con rol empleado no asignado
        $empleado = User::role('empleado')
            ->whereDoesntHave('grupoTrabajo')
            ->first();

        // Crear grupo
        $grupo = GrupoTrabajo::firstOrCreate([
            'nombre' => 'Grupo Simulado',
            'car_id' => $auto?->id,
        ]);

        // Asignar empleado
        if ($empleado) {
            $grupo->empleados()->syncWithoutDetaching([$empleado->id]);
        }

        // Asignar tareas con datos de cliente
        $tareas = Tarea::all();
        foreach ($tareas as $tarea) {
            $grupo->tareas()->attach($tarea->id, [
                'cliente' => 'Cliente de '.$tarea->titulo,
                'costo_final' => rand(1000, 3000),
                'notas_cliente' => 'Notas para '.$tarea->titulo,
                'estado' => 'pendiente',
            ]);
        }
    }
}
