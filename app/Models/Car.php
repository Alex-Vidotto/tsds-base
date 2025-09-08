<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
