<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'rol',
        'nivel_id',
        'foto_perfil',
        'estado'
    ];
}