<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Página pública
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Redirección automática después de login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role.redirect'])->group(function () {
    Route::get('/redirect-role', function () {
        // Aquí no va nada, solo usa el middleware
    })->name('redirect.role');
});


/*
|--------------------------------------------------------------------------
| Dashboard (solo se usa si el usuario no tiene rol válido)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('redirect.role');
})->middleware(['auth']);



/*
|--------------------------------------------------------------------------
| Perfil
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| RUTAS POR ROL (solo para mostrar la vista correspondiente)
|--------------------------------------------------------------------------
*/

// ADMIN (rol_id = 1)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// EMPRENDEDOR (rol_id = 2)
Route::middleware(['auth'])->group(function () {
    Route::get('/emprendedor/dashboard', function () {
        return view('emprendedor.dashboard');
    })->name('emprendedor.dashboard');
});

// CLIENTE (rol_id = 3)
Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/dashboard', function () {
        return view('cliente.dashboard');
    })->name('cliente.dashboard');
});


/*
|--------------------------------------------------------------------------
| Autenticación (Laravel Breeze/Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
