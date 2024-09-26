<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function profesor(){
        return $this->belongsTo(Profesor::class);
    }
    public function curso(){
        return $this->belongsTo(Curso::class);
    }
}
