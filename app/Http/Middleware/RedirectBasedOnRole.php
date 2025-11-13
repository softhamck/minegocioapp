<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Roles basados en tu tabla roles
        return match ($user->rol_id) {
            1 => redirect()->route('admin.dashboard'),
            2 => redirect()->route('emprendedor.dashboard'),
            3 => redirect()->route('cliente.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }
}
