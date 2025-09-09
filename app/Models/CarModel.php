<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = [
    'nombre',
    'car_brand_id'
    ];
    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class, 'car_brand_id');
    }
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
