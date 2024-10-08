<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id'); // Asegúrate de que 'cliente_id' sea la clave foránea
    }
}
