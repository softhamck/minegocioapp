<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * $roleParam puede ser '1' (id) o 'Admin' (nombre)
     */
    public function handle(Request $request, Closure $next, $roleParam): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Si pasaron un número, lo comparamos con rol_id
        if (is_numeric($roleParam)) {
            if ((int) $user->rol_id !== (int) $roleParam) {
                abort(403);
            }
            return $next($request);
        }

        // Si pasaron texto, comparamos con el nombre del rol (si existe relacion 'rol')
        $roleName = strtolower($roleParam);
        $userRoleName = strtolower($user->rol->name ?? $user->rol->nombre ?? '');

        if ($userRoleName !== $roleName) {
            abort(403);
        }

        return $next($request);
    }
}
