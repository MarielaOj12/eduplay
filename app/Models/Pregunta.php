<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';

    protected $fillable = [
        'actividad_id',
        'enunciado',
        'tipo_pregunta',
        'opcion_a',
        'opcion_b',
        'opcion_c',
        'opcion_d',
        'respuesta_correcta',
        'retroalimentacion',
        'puntaje'
    ];
}