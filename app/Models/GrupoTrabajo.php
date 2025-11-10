<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoTrabajo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'car_id'];

    // Relación 1 a 1 con auto
    public function auto()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    // Relación 1 a muchos con empleados
    public function empleados()
    {
        return $this->belongsToMany(User::class, 'grupo_trabajo_usuario', 'grupo_trabajo_id', 'user_id');
    }

    // Relación con tareas
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'servicios_asignados')
            ->withPivot(['cliente', 'costo_final', 'notas_cliente', 'estado'])
            ->withTimestamps();
    }
}
