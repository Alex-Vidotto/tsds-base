<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarService extends Model
{
    use HasFactory;
    protected $fillable = ['Tipo_servicio'];
    // un servicio tiene muchos autos
    public function cars_service_dates(){
        return $this->hasMany(CarServicesDate::class, 'car_service_id');
    }

    public function cars(){
        return $this->belongsToMany(Car::class,'car_service_dates', 'car_service_id', 'car_id')
                    ->withPivot('fecha_mantenimiento')
                    ->withTimestamps();
    }
}

