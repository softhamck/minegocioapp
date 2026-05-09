<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Emprendedor\BusinessController;
use App\Http\Controllers\Emprendedor\EmprendedorDashboardController;
use App\Http\Controllers\Cliente\BusinessClientController;
use App\Http\Controllers\Cliente\CartClientController;
use App\Http\Controllers\Cliente\OrderClientController;
use App\Http\Controllers\Cliente\ProductClientController;
use App\Http\Controllers\Cliente\StoreClientController;
use App\Http\Controllers\Cliente\CartController;

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

        // CRUD Productos (COMPLETO)
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Pedidos
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });

// EMPRENDEDOR (rol_id = 2)
Route::middleware(['auth', 'role:2'])
    ->prefix('emprendedor')
    ->name('emprendedor.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\Emprendedor\EmprendedorDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/products', [\App\Http\Controllers\Emprendedor\ProductController::class, 'allProducts'])
            ->name('products.all');

        // CRUD Negocios
        Route::get('/business', [BusinessController::class, 'index'])->name('business.index');
        Route::get('/business/create', [BusinessController::class, 'create'])->name('business.create');
        Route::post('/business', [BusinessController::class, 'store'])->name('business.store');
        Route::get('/business/{business}', [BusinessController::class, 'show'])->name('business.show');
        Route::get('/business/{business}/edit', [BusinessController::class, 'edit'])->name('business.edit');
        Route::put('/business/{business}', [BusinessController::class, 'update'])->name('business.update');
        Route::delete('/business/{business}', [BusinessController::class, 'destroy'])->name('business.destroy');

        // Pedidos del emprendedor (si aplica)
        Route::get('/orders', [\App\Http\Controllers\Emprendedor\OrderController::class, 'index'])
            ->name('orders.index');

        // PRODUCTOS POR NEGOCIO
        Route::prefix('business/{business}')
            ->name('business.')
            ->group(function () {
                Route::get('/products', [\App\Http\Controllers\Emprendedor\ProductController::class, 'index'])
                    ->name('products.index');

                Route::get('/products/create', [\App\Http\Controllers\Emprendedor\ProductController::class, 'create'])
                    ->name('products.create');

                Route::post('/products', [\App\Http\Controllers\Emprendedor\ProductController::class, 'store'])
                    ->name('products.store');

                Route::get('/products/{product}/edit', [\App\Http\Controllers\Emprendedor\ProductController::class, 'edit'])
                    ->name('products.edit');

                Route::put('/products/{product}', [\App\Http\Controllers\Emprendedor\ProductController::class, 'update'])
                    ->name('products.update');

                Route::delete('/products/{product}', [\App\Http\Controllers\Emprendedor\ProductController::class, 'destroy'])
                    ->name('products.destroy');
            });
    });

// CLIENTE (rol_id = 3)
Route::middleware(['auth', 'role:3'])
    ->prefix('cliente')
    ->name('cliente.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            return view('cliente.dashboard');
        })->name('dashboard');

        // Catálogo de productos
        Route::get('/productos', [ProductClientController::class, 'index'])->name('productos.index');
        Route::get('/productos/{product}', [ProductClientController::class, 'show'])->name('productos.show');

        // Carrito de compras
        Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');
        Route::post('/carrito/{productId}/add', [CartController::class, 'add'])->name('carrito.add');
        Route::patch('/carrito/{productId}/update', [CartController::class, 'update'])->name('carrito.update');
        Route::delete('/carrito/{productId}/remove', [CartController::class, 'remove'])->name('carrito.remove');
        Route::delete('/carrito/clear', [CartController::class, 'clear'])->name('carrito.clear');

        // Pedidos del cliente
        Route::get('/pedidos', [\App\Http\Controllers\Cliente\OrderController::class, 'index'])->name('pedidos.index');
        Route::get('/pedidos/{order}', [\App\Http\Controllers\Cliente\OrderController::class, 'show'])->name('pedidos.show');        
    });

// Autenticación (Laravel Breeze)
require __DIR__ . '/auth.php';