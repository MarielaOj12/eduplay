<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request)
    {
        // If using token-based auth (Sanctum/Passport) revoke current access token
        if ($request->user() && method_exists($request->user(), 'currentAccessToken')) {
            $token = $request->user()->currentAccessToken();
            if ($token) {
                $token->delete();
            }
        }

        // For session-based auth, log out and invalidate session
        try {
            Auth::logout();
        } catch (\Throwable $e) {
            // ignore if guard not configured for sessions
        }

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->json([
            'success' => true,
            'message' => 'Sesión cerrada'
        ]);
    }
}