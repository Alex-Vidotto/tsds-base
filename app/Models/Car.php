<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricula',
        'car_model_id',
        'foto'
    ];
    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function carServiceDates(){
        return $this->hasMany(CarServiceDate::class, 'car_id');
    }

    public function carService(){
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
        $ultimo = $this->carServiceDates()->orderByDesc('fecha_mantenimiento')->first();

        if ($ultimo && Carbon::parse($ultimo->fecha_mantenimiento)->isFuture()) {
            $this->estado = 'En mantenimiento';
        } else {
            $this->estado = 'Disponible';
        }

        $this->save();
    }

}

