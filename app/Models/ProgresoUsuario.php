<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresoUsuario extends Model
{
    protected $table = 'progreso_usuario';

    protected $fillable = [
        'usuario_id',
        'nivel_actual_id',
        'actividades_completadas',
        'puntaje_total',
        'porcentaje_avance'
    ];
}