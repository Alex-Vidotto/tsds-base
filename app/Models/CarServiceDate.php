<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarServiceDate extends Model
{
    use HasFactory;
    protected $fillable = ['fecha_mantenimiento',
    'car_id',
    'car_service_id',
    'estado'];


    // un registro tiene muchos servicios y muchos autos repetidos

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public function carService(){
        return $this->belongsTo(CarService::class);
    }
}
