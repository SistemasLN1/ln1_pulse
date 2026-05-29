<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $usuario = User::where('usuario_email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->contraseña)) {
            return response()->json([
                'mensaje' => 'Correo o contraseña incorrectos.',
            ], 401);
        }

        $token = $usuario->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'usuario' => [
                'id' => $usuario->id_usuario,
                'nombre' => $usuario->usuario_nombres,
                'correo' => $usuario->usuario_email,
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'mensaje' => 'Token eliminado correctamente.',
        ]);
    }

    public function me(Request $request)
    {
        $usuario = $request->user();

        return response()->json([
            'id' => $usuario->id_usuario,
            'nombre' => $usuario->usuario_nombres,
            'correo' => $usuario->usuario_email,
        ]);
    }

    public function refreshToken(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $nuevoToken = $request->user()->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $nuevoToken,
        ]);
    }
}