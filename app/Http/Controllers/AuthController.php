<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $usuario = Usuario::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'Correo o contraseña incorrectos'
            ], 401);
        }

        $nivel = null;

        if ($usuario->nivel_id) {
            $nivel = DB::table('niveles')
                ->where('id', $usuario->nivel_id)
                ->first();
        }

        return response()->json([
            'success' => true,
            'message' => 'Login correcto',
            'usuario' => $usuario,
            'nivel' => $nivel
        ]);
    }
}