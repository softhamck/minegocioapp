<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MiNegocioApp') }} - Cliente</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .cliente-gradient {
                background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .hover-glow:hover {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
            }
            /* Asegurar que el dropdown esté por encima del contenido */
            .dropdown-content {
                z-index: 1000;
            }
        </style>
    </head>
    <body class="font-sans antialiased cliente-gradient min-h-screen">
        <div class="flex flex-col min-h-screen">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="glass-card border-b border-gray-700/50 shadow-lg relative z-40">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">MN</span>
                                </div>
                                {{ $header }}
                            </div>
                            
                            <!-- Navigation Menu -->
                            <nav class="hidden sm:flex items-center space-x-4">
                                <x-nav-link :href="url('cliente.dashboard')" :active="request()->is('cliente/dashboard')" class="text-gray-300 hover:text-white transition-colors">
                                    Dashboard
                                </x-nav-link>
                                
                                <x-nav-link :href="url('cliente.productos.index')" :active="request()->is('cliente/productos*')" class="text-gray-300 hover:text-white transition-colors">
                                    Productos
                                </x-nav-link>
                                
                                <x-nav-link :href="url('cliente.pedidos.index')" :active="request()->is('cliente/pedidos*')" class="text-gray-300 hover:text-white transition-colors">
                                    Mis Pedidos
                                </x-nav-link>

                                <x-nav-link :href="url('cliente.carrito.index')" :active="request()->is('cliente/carrito*')" class="text-gray-300 hover:text-white transition-colors relative">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Carrito
                                    @if($cartCount ?? 0 > 0)
                                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                            {{ $cartCount }}
                                        </span>
                                    @endif
                                </x-nav-link>
                                
                                <!-- Settings Dropdown -->
                                <div class="relative dropdown-content">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex items-center text-sm font-medium text-gray-300 hover:text-white transition-colors focus:outline-none focus:text-white">
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center">
                                                        <span class="text-white text-sm font-bold">
                                                            {{ substr(Auth::user()->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                                                </div>
                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content" class="z-50">
                                            <x-dropdown-link :href="url('profile.edit')" class="text-gray-300 hover:text-white flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                Mi Perfil
                                            </x-dropdown-link>

                                            <x-dropdown-link :href="url('cliente.favoritos.index')" class="text-gray-300 hover:text-white flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                                Favoritos
                                            </x-dropdown-link>
                                            
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ url('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="url('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();"
                                                        class="text-red-400 hover:text-red-300 border-t border-gray-700 mt-2 pt-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                    </svg>
                                                    {{ __('Cerrar Sesión') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </nav>

                            <!-- Hamburger Menu (Mobile) -->
                            <div class="sm:hidden dropdown-content">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="text-gray-300 hover:text-white transition-colors">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content" class="z-50">
                                        <x-dropdown-link :href="url('cliente.dashboard')" class="text-gray-300 hover:text-white">
                                            Dashboard
                                        </x-dropdown-link>
                                        
                                        <x-dropdown-link :href="url('cliente.productos.index')" class="text-gray-300 hover:text-white">
                                            Productos
                                        </x-dropdown-link>
                                        
                                        <x-dropdown-link :href="url('cliente.pedidos.index')" class="text-gray-300 hover:text-white">
                                            Mis Pedidos
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="url('cliente.carrito.index')" class="text-gray-300 hover:text-white">
                                            Carrito
                                            @if($cartCount ?? 0 > 0)
                                                <span class="ml-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                                    {{ $cartCount }}
                                                </span>
                                            @endif
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="url('cliente.favoritos.index')" class="text-gray-300 hover:text-white">
                                            Favoritos
                                        </x-dropdown-link>
                                        
                                        <div class="border-t border-gray-700 mt-2 pt-2">
                                            <x-dropdown-link :href="url('profile.edit')" class="text-gray-300 hover:text-white">
                                                Mi Perfil
                                            </x-dropdown-link>
                                            
                                            <form method="POST" action="{{ url('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="url('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();"
                                                        class="text-red-400 hover:text-red-300">
                                                    {{ __('Cerrar Sesión') }}
                                                </x-dropdown-link>
                                            </form>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 relative z-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>