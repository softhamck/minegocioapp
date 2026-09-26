<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Http\Responses\LoginResponse as CustomLoginResponse;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);

        // En hosting compartido sin symlink (ej. InfinityFree), la app vive un
        // nivel por debajo del document root real (htdocs/laravel/ en vez de
        // htdocs/), asi que public_path() debe apuntar un nivel arriba para
        // que el manifest de Vite y las URLs de assets se resuelvan bien.
        if (env('SHARED_HOSTING_STORAGE', false)) {
            $this->app->usePublicPath(dirname($this->app->basePath()));
        }
    }

    public function boot(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
    }
}
