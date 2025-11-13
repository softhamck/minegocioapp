<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (! Auth::attempt($credentials, $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => 'Credenciales incorrectas',
        ]);
    }

    $request->session()->regenerate();

    // AQUÍ recuperas el usuario ya autenticado
    $user = Auth::user();

    // Ahora sí puedes usar su rol
    return match ($user->rol_id) {
        1 => redirect()->route('admin.dashboard'),
        2 => redirect()->route('emprendedor.dashboard'),
        3 => redirect()->route('cliente.dashboard'),
        default => redirect()->route('dashboard'),
    };
}




    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
