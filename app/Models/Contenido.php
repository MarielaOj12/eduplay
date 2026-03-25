<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    protected $table = 'contenidos';

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo_contenido',
        'nivel_id',
        'tema',
        'url_archivo',
        'contenido_texto',
        'creado_por',
        'estado'
    ];
}