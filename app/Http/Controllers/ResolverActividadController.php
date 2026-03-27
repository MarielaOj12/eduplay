<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pregunta;
use Illuminate\Support\Facades\DB;

class ResolverActividadController extends Controller
{
    public function obtenerPreguntas($actividadId)
    {
        $preguntas = Pregunta::where('actividad_id', $actividadId)->get();
        return response()->json($preguntas);
    }
    
}