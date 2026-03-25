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

public function resolver(Request $request)
{
    $usuarioId = $request->usuario_id;
    $actividadId = $request->actividad_id;
    $respuestas = $request->respuestas;

    $preguntas = Pregunta::where('actividad_id', $actividadId)->get();

    $puntajeTotal = 0;
    $correctas = 0;
    $incorrectas = 0;
    $detalleRespuestas = [];

    $intentoId = DB::table('intentos_actividad')->insertGetId([
        'usuario_id' => $usuarioId,
        'actividad_id' => $actividadId,
        'fecha_inicio' => now(),
        'fecha_fin' => now(),
        'puntaje_obtenido' => 0,
        'total_correctas' => 0,
        'total_incorrectas' => 0,
        'estado' => 'finalizado'
    ]);

    foreach ($preguntas as $pregunta) {
        $respuestaUsuario = $respuestas[$pregunta->id] ?? null;
        $esCorrecta = $respuestaUsuario == $pregunta->respuesta_correcta;

        if ($esCorrecta) {
            $puntajeTotal += $pregunta->puntaje;
            $correctas++;
        } else {
            $incorrectas++;
        }

        DB::table('respuestas_usuario')->insert([
            'intento_id' => $intentoId,
            'pregunta_id' => $pregunta->id,
            'respuesta_usuario' => $respuestaUsuario,
            'es_correcta' => $esCorrecta,
            'puntaje_obtenido' => $esCorrecta ? $pregunta->puntaje : 0,
            'created_at' => now()
        ]);

        $detalleRespuestas[] = [
            'pregunta' => $pregunta->enunciado,
            'respuesta_usuario' => $respuestaUsuario,
            'respuesta_correcta' => $pregunta->respuesta_correcta,
            'es_correcta' => $esCorrecta,
            'retroalimentacion' => $pregunta->retroalimentacion,
            'puntaje' => $pregunta->puntaje
        ];
    }

    DB::table('intentos_actividad')
        ->where('id', $intentoId)
        ->update([
            'puntaje_obtenido' => $puntajeTotal,
            'total_correctas' => $correctas,
            'total_incorrectas' => $incorrectas
        ]);

    $registroProgreso = DB::table('progreso_usuario')
        ->where('usuario_id', $usuarioId)
        ->first();

    if ($registroProgreso) {
        $nuevoPuntaje = $registroProgreso->puntaje_total + $puntajeTotal;
        $nuevasActividades = $registroProgreso->actividades_completadas + 1;
        $nuevoPorcentaje = min(100, $registroProgreso->porcentaje_avance + 10);

        DB::table('progreso_usuario')
            ->where('usuario_id', $usuarioId)
            ->update([
                'puntaje_total' => $nuevoPuntaje,
                'actividades_completadas' => $nuevasActividades,
                'porcentaje_avance' => $nuevoPorcentaje,
                'ultima_actividad' => now(),
                'updated_at' => now()
            ]);
    }
    $temasFallados = [];

foreach ($preguntas as $pregunta) {
    $respuestaUsuario = $respuestas[$pregunta->id] ?? null;

    if ($respuestaUsuario != $pregunta->respuesta_correcta) {
        $temasFallados[] = $pregunta->enunciado;
    }
}

$recomendaciones = DB::table('contenidos')
    ->where(function ($query) use ($preguntas) {
        foreach ($preguntas as $pregunta) {
            $query->orWhere('tema', 'like', '%' . $pregunta->enunciado . '%');
        }
    })
    ->limit(3)
    ->get();

    return response()->json([
        'success' => true,
        'message' => 'Actividad resuelta correctamente',
        'puntaje_total' => $puntajeTotal,
        'correctas' => $correctas,
        'incorrectas' => $incorrectas,
        'detalle_respuestas' => $detalleRespuestas,
        'recomendaciones' => $recomendaciones
    ]);
}
}