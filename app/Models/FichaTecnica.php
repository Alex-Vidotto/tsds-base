<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    use HasFactory;

    protected $table = 'ficha_tecnica';

    protected $fillable = [
        'car_id',
        'motor',
        'combustible',
        'transmision',
        'color',
        'anio',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    
}
