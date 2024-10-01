<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Cliente extends Model
{
    use HasRoles, HasFactory;

    protected $table = "clientes";

    protected $guard_name = 'web';
    protected $guarded = ['created_at', 'updated_at'];

    // Relación: Cliente pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
