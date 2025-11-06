<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricula',
        'car_model_id',
        'foto',
    ];

    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function carServiceDates()
    {
        return $this->hasMany(CarServiceDate::class, 'car_id');
    }

    public function carService()
    {
        return $this->belongsToMany(CarService::class, 'car_service_dates', 'car_id', 'car_service_id')
            ->withPivot('fecha_mantenimiento')
            ->withTimestamps();
    }

    public function grupoTrabajo()
    {
        return $this->hasOne(GrupoTrabajo::class, 'car_id');
    }

    public function fichaTecnica()
    {
        return $this->hasOne(FichaTecnica::class);
    }

    public function actualizarEstado()
    {
        $hoy = Carbon::today();
        $limiteFuturo = $hoy->copy()->addDays(7);

        $mantenimientoHoy = $this->carServiceDates()
            ->whereDate('fecha_mantenimiento', $hoy)
            ->exists();

        $mantenimientoProximo = $this->carServiceDates()
            ->whereDate('fecha_mantenimiento', '>', $hoy)
            ->whereDate('fecha_mantenimiento', '<=', $limiteFuturo)
            ->exists();

        if ($mantenimientoHoy) {
            $this->estado = 'En mantenimiento';
        } elseif ($mantenimientoProximo) {
            $this->estado = 'Mantenimiento programado';
        } else {
            $this->estado = 'Disponible';
        }

        $this->save();
    }
}
