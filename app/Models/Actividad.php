<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo_actividad',
        'nivel_id',
        'tema',
        'puntaje_maximo',
        'tiempo_limite_min',
        'creado_por',
        'estado'
    ];
}