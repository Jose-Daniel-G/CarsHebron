<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';
    // protected $fillable = ['nombre', 'modelo', 'tipo']; // Agregar 'placa' si se actualiza

    protected $fillable = [
        'placa',
        'modelo',
        'disponible',
        'pico_y_placa',
    ];
    // protected $fillable = [
    //     // 'marca','anio','color', 'pico_y_placa',
    //     'placa','nombre','modelo', 'tipo','disponible',];

    // protected $casts = [
    //     'anio' => 'integer',
    // ];
}
