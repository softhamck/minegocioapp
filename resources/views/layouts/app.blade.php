<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MiNegocioApp') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .admin-gradient {
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
        </style>
    </head>
    <body class="font-sans antialiased admin-gradient min-h-screen">
        <div class="flex flex-col min-h-screen">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="glass-card border-b border-gray-700/50 shadow-lg">
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
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white transition-colors">
                                    Dashboard
                                </x-nav-link>
                                
                                @if(Auth::user()->rol_id == 1) <!-- Admin -->
                                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-gray-300 hover:text-white transition-colors">
                                        Usuarios
                                    </x-nav-link>
                                    <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')" class="text-gray-300 hover:text-white transition-colors">
                                        Pedidos
                                    </x-nav-link>
                                    <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" class="text-gray-300 hover:text-white transition-colors">
                                        Productos
                                    </x-nav-link>
                                @endif
                                
                                <!-- Settings Dropdown -->
                                <div class="relative">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex items-center text-sm font-medium text-gray-300 hover:text-white transition-colors focus:outline-none focus:text-white">
                                                <div>{{ Auth::user()->name }}</div>
                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();"
                                                        class="text-red-400 hover:text-red-300">
                                                    {{ __('Cerrar Sesión') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </nav>

                            <!-- Hamburger Menu (Mobile) -->
                            <div class="sm:hidden">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="text-gray-300 hover:text-white transition-colors">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('dashboard')" class="text-gray-300 hover:text-white">
                                            Dashboard
                                        </x-dropdown-link>
                                        
                                        @if(Auth::user()->rol_id == 1)
                                            <x-dropdown-link :href="route('admin.users.index')" class="text-gray-300 hover:text-white">
                                                Usuarios
                                            </x-dropdown-link>
                                            <x-dropdown-link :href="route('admin.orders.index')" class="text-gray-300 hover:text-white">
                                                Pedidos
                                            </x-dropdown-link>
                                            <x-dropdown-link :href="route('admin.products.index')" class="text-gray-300 hover:text-white">
                                                Productos
                                            </x-dropdown-link>
                                        @endif
                                        
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();"
                                                    class="text-red-400 hover:text-red-300 border-t border-gray-700 mt-2 pt-2">
                                                {{ __('Cerrar Sesión') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>