<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ClienteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('cliente.*', function ($view) {
        if (Auth::check() && Auth::user()->rol_id == 3) {
            // El carrito se guarda en la sesión (ver Cliente\CartController)
            $cartCount = collect(session('cart', []))->sum('quantity');
            $view->with('cartCount', $cartCount);
        }
    });
    }

    public function register()
    {
        //
    }
}