<?php

namespace App\Http\Controllers;

use App\Models\ProgresoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgresoUsuarioController extends Controller
{
    public function index()
    {
        return response()->json(ProgresoUsuario::all());
    }

    public function mostrarPorUsuario($usuarioId)
    {
        $progreso = DB::table('progreso_usuario')
            ->where('usuario_id', $usuarioId)
            ->first();

        $intentos = DB::table('intentos_actividad')
            ->join('actividades', 'intentos_actividad.actividad_id', '=', 'actividades.id')
            ->where('intentos_actividad.usuario_id', $usuarioId)
            ->select(
                'intentos_actividad.id',
                'intentos_actividad.puntaje_obtenido',
                'intentos_actividad.total_correctas',
                'intentos_actividad.total_incorrectas',
                'intentos_actividad.fecha_fin',
                'actividades.titulo as actividad'
            )
            ->orderBy('intentos_actividad.id', 'desc')
            ->get();

        return response()->json([
            'progreso' => $progreso,
            'intentos' => $intentos
        ]);
    }
}