<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','ubicacion', 'capacidad', 'telefono','especialidad','estado'];

    public function profesores(){
        return $this->hasMany(Profesor::class);
    }
    public function horarios(){
        return $this->hasMany(Horario::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
