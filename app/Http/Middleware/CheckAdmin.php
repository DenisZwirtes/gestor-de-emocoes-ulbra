<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = session('usuario');

        if (!$usuario || $usuario->tipo_usuario !== 'admin') {
            return redirect()->route('admin.erroAutorizacao')->with('erroAutorizacao', 'Você não está autorizado para acessar esta página!')->setStatusCode(401);
        }

        return $next($request);
    }
}
