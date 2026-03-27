<?php

namespace App\Http\Controllers;

use App\Models\Contenido;
use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    public function index()
    {
        return response()->json(Contenido::all());
    }

    public function store(Request $request)
    {
        $contenido = Contenido::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo_contenido' => $request->tipo_contenido,
            'nivel_id' => $request->nivel_id,
            'tema' => $request->tema,
            'url_archivo' => $request->url_archivo,
            'contenido_texto' => $request->contenido_texto,
            'creado_por' => $request->creado_por,
            'estado' => 'activo'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contenido creado correctamente',
            'contenido' => $contenido
        ]);
    }

    public function update(Request $request, $id)
    {
        $contenido = Contenido::find($id);

        if (!$contenido) {
            return response()->json([
                'success' => false,
                'message' => 'Contenido no encontrado'
            ], 404);
        }

        $contenido->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo_contenido' => $request->tipo_contenido,
            'nivel_id' => $request->nivel_id,
            'tema' => $request->tema,
            'url_archivo' => $request->url_archivo,
            'contenido_texto' => $request->contenido_texto,
            'creado_por' => $request->creado_por,
            'estado' => $request->estado ?? $contenido->estado
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contenido actualizado correctamente',
            'contenido' => $contenido
        ]);
    }

}