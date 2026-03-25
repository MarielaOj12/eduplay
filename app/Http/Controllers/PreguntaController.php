<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function index()
    {
        return response()->json(Pregunta::all());
    }

    public function store(Request $request)
    {
        $pregunta = Pregunta::create([
            'actividad_id' => $request->actividad_id,
            'enunciado' => $request->enunciado,
            'tipo_pregunta' => $request->tipo_pregunta,
            'opcion_a' => $request->opcion_a,
            'opcion_b' => $request->opcion_b,
            'opcion_c' => $request->opcion_c,
            'opcion_d' => $request->opcion_d,
            'respuesta_correcta' => $request->respuesta_correcta,
            'retroalimentacion' => $request->retroalimentacion,
            'puntaje' => $request->puntaje
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pregunta creada correctamente',
            'pregunta' => $pregunta
        ]);
    }

    public function update(Request $request, $id)
    {
        $pregunta = Pregunta::find($id);

        if (!$pregunta) {
            return response()->json([
                'success' => false,
                'message' => 'Pregunta no encontrada'
            ], 404);
        }

        $pregunta->update([
            'actividad_id' => $request->actividad_id,
            'enunciado' => $request->enunciado,
            'tipo_pregunta' => $request->tipo_pregunta,
            'opcion_a' => $request->opcion_a,
            'opcion_b' => $request->opcion_b,
            'opcion_c' => $request->opcion_c,
            'opcion_d' => $request->opcion_d,
            'respuesta_correcta' => $request->respuesta_correcta,
            'retroalimentacion' => $request->retroalimentacion,
            'puntaje' => $request->puntaje
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pregunta actualizada correctamente',
            'pregunta' => $pregunta
        ]);
    }

    public function destroy($id)
    {
        $pregunta = Pregunta::find($id);

        if (!$pregunta) {
            return response()->json([
                'success' => false,
                'message' => 'Pregunta no encontrada'
            ], 404);
        }

        $pregunta->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pregunta eliminada correctamente'
        ]);
    }
}