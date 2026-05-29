<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permiso): Response
    {
        $usuario = $request->user();

        $tienePermiso = DB::table('usuario_rol')
            ->join('rol_permiso', 'usuario_rol.id_rol', '=', 'rol_permiso.id_rol')
            ->join('permiso', 'rol_permiso.id_permiso', '=', 'permiso.id_permiso')
            ->where('usuario_rol.id_usuario', $usuario->id_usuario)
            ->where('permiso.nombre', $permiso)
            ->exists();

        if (!$tienePermiso)
            return response()->json(['mensaje' => 'Acceso denegado.'], 403);

        return $next($request);
    }
}
