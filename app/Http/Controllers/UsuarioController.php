<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json(Usuario::all());
    }

    public function store(Request $request)
    {
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => $request->password,
            'rol' => $request->rol,
            'nivel_id' => $request->nivel_id ? $request->nivel_id : null,
            'estado' => 'activo'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente',
            'usuario' => $usuario
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => $request->password,
            'rol' => $request->rol,
            'nivel_id' => $request->nivel_id ? $request->nivel_id : null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente',
            'usuario' => $usuario
        ]);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $usuario->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado correctamente'
        ]);
    }

    public function saludo()
    {
        return response()->json([
            'success' => true,
            'message' => 'Endpoint de prueba funcionando correctamente'
        ]);
    }
}