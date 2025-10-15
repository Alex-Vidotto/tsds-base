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
        return $this->hasMany(User::class);
    }

    // Relación con tareas 
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }    
}
