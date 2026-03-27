<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function index()
    {
        return response()->json(Actividad::all());
    }
        public function store(Request $request)
    {
        $actividad = Actividad::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo_actividad' => $request->tipo_actividad,
            'nivel_id' => $request->nivel_id,
            'tema' => $request->tema,
            'puntaje_maximo' => $request->puntaje_maximo,
            'tiempo_limite_min' => $request->tiempo_limite_min,
            'creado_por' => $request->creado_por,
            'estado' => 'activo'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Actividad creada',
            'actividad' => $actividad
        ]);
    }

    public function update(Request $request, $id)
    {
        $actividad = Actividad::find($id);

        if (!$actividad) {
            return response()->json([
                'success' => false,
                'message' => 'Actividad no encontrada'
            ], 404);
        }

        $actividad->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo_actividad' => $request->tipo_actividad,
            'nivel_id' => $request->nivel_id,
            'tema' => $request->tema,
            'puntaje_maximo' => $request->puntaje_maximo,
            'tiempo_limite_min' => $request->tiempo_limite_min,
            'creado_por' => $request->creado_por,
            'estado' => $request->estado ?? $actividad->estado
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Actividad actualizada',
            'actividad' => $actividad
        ]);
    }

    public function destroy($id)
    {
        $actividad = Actividad::find($id);

        if (!$actividad) {
            return response()->json([
                'success' => false,
                'message' => 'Actividad no encontrada'
            ], 404);
        }

        $actividad->delete();

        return response()->json([
            'success' => true,
            'message' => 'Actividad eliminada'
        ]);
    }

}