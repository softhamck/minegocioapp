<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Página Publica
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Principal
Route::get('/dashboard', function () {
    return redirect()->route('redirect.role');
})->middleware(['auth'])->name('dashboard');

// Redirección por Rol
Route::get('/redirect-role', function () {
    $user = auth()->user();
    switch ($user->rol_id) {
        case 1:
            return redirect()->route('admin.dashboard');
        case 2:
            return redirect()->route('emprendedor.dashboard');
        case 3:
            return redirect()->route('cliente.dashboard');
        default:
            return redirect('/'); // o alguna página de error
    }
})->middleware(['auth'])->name('redirect.role');

// Perfil
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

//Dashboard por Rol

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

// Autenticación (Laravel Breeze)
require __DIR__.'/auth.php';
