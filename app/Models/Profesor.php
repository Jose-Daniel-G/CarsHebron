<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    protected $table = 'profesors'; // Si la tabla se llama 'profesors'

    protected $fillable=['nombres','apellidos','telefono','licencia_medica','especialidad',
    'user_id',  // Asegúrate de agregarlo aquí
    ];
    public function curso(){
        return $this->belongsTo(Curso::class);
    }
    public function horarios(){
        return $this->hasMany(Horario::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function historial()
    {
        return $this->hasMany(Historial::class);
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
