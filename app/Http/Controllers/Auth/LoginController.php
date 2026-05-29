<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function iniciarSesion(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $usuario = User::where('usuario_email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->contraseña)) {
            return response()->json(['mensaje' => 'Correo o contraseña incorrectos.'], 401);
        }

        Auth::login($usuario, $request->boolean('recordar'));
        $request->session()->regenerate();

        return response()->json([
            'mensaje' => 'Sesión iniciada correctamente.',
            'usuario' => [
                'nombre' => $usuario->usuario_nombres,
                'correo' => $usuario->usuario_email,
            ],
        ]);
    }

    public function cerrarSesion(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['mensaje' => 'Sesión cerrada.']);
    }
}