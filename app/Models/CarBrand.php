<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }
}
