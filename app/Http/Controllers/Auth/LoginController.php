<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function iniciarSesion(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credenciales = [
            'usuario_email' => $request->email,
            'password'      => $request->password,
        ];

        if (!Auth::attempt($credenciales, $request->boolean('recordar'))) {

            return response()->json([
                'mensaje' => 'Correo o contraseña incorrectos.',
            ], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'mensaje' => 'Sesión iniciada correctamente.',
            'usuario' => [
                'nombre' => Auth::user()->usuario_nombres,
                'correo' => Auth::user()->usuario_email,
            ],
        ]);
    }

    public function cerrarSesion(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'mensaje' => 'Sesión cerrada.',
        ]);
    }
}