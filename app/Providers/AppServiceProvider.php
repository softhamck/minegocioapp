<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
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

        // Correo de recuperación de contraseña en español
        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            $minutos = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

            return (new MailMessage)
                ->subject('Restablece tu contraseña de MiNegocioApp')
                ->greeting('¡Hola, ' . $notifiable->name . '!')
                ->line('Recibimos una solicitud para restablecer la contraseña de tu cuenta en MiNegocioApp.')
                ->action('Crear una nueva contraseña', $url)
                ->line("Este enlace vence en {$minutos} minutos.")
                ->line('Si tú no hiciste esta solicitud, puedes ignorar este correo: tu contraseña seguirá siendo la misma.')
                ->salutation('Con cariño, el equipo de MiNegocioApp 💜');
        });
    }
}
