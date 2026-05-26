<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarAutenticacion
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check()) {
            return response()->json([
                'mensaje' => 'No autenticado.',
            ], 401);
        }

        return $next($request);
    }
}