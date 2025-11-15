<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

// Página pública
Route::get('/', function () {
    return view('welcome');
});

// Dashboard principal (redirección por rol)
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
            return redirect('/');
    }
})->middleware(['auth'])->name('redirect.role');


// Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Dashboard por Rol

// ADMIN (rol_id = 1) - Rutas completas
Route::middleware(['auth', 'role:1'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // CRUD Usuarios
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Productos
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');

        // Pedidos
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    });


// EMPRENDEDOR (rol_id = 2)
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/emprendedor/dashboard', function () {
        return view('emprendedor.dashboard');
    })->name('emprendedor.dashboard');
});

// CLIENTE (rol_id = 3)
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/cliente/dashboard', function () {
        return view('cliente.dashboard');
    })->name('cliente.dashboard');
});


// Autenticación (Laravel Breeze)
require __DIR__.'/auth.php';
