<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse
    {
        $user = Auth::user();

        return match ($user->rol_id) {
            1 => redirect()->route('admin.dashboard'),
            2 => redirect()->route('emprendedor.dashboard'),
            3 => redirect()->route('cliente.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }
}
