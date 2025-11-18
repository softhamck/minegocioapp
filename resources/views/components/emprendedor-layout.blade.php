<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MiNegocioApp') }} - Emprendedor</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .emprendedor-gradient {
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
            .dropdown-content {
                z-index: 1000;
            }
        </style>
    </head>
    <body class="font-sans antialiased emprendedor-gradient min-h-screen">
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
                                <x-nav-link :href="url('emprendedor.dashboard')" :active="request()->is('emprendedor/dashboard')" class="text-gray-300 hover:text-white transition-colors">
                                    Dashboard
                                </x-nav-link>
                                
                                <x-nav-link :href="url('emprendedor.business.index')" :active="request()->is('emprendedor/business*')" class="text-gray-300 hover:text-white transition-colors">
                                    Mis Negocios
                                </x-nav-link>
                                
                                <x-nav-link :href="url('emprendedor.products.index')" :active="request()->is('emprendedor/products*')" class="text-gray-300 hover:text-white transition-colors">
                                    Productos
                                </x-nav-link>

                                <x-nav-link :href="url('emprendedor.orders.index')" :active="request()->is('emprendedor/orders*')" class="text-gray-300 hover:text-white transition-colors">
                                    Pedidos
                                </x-nav-link>

                                <x-nav-link :href="url('emprendedor.analytics')" :active="request()->is('emprendedor/analytics*')" class="text-gray-300 hover:text-white transition-colors">
                                    Métricas
                                </x-nav-link>
                                
                                <!-- Settings Dropdown -->
                                <div class="relative dropdown-content">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex items-center text-sm font-medium text-gray-300 hover:text-white transition-colors focus:outline-none focus:text-white">
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-amber-500 rounded-full flex items-center justify-center">
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
                                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-white flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                Mi Perfil
                                            </x-dropdown-link>

                                            <x-dropdown-link :href="url('emprendedor.settings')" class="text-gray-300 hover:text-white flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                Configuración
                                            </x-dropdown-link>
                                            
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
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
                                        <x-dropdown-link :href="url('emprendedor.dashboard')" class="text-gray-300 hover:text-white">
                                            Dashboard
                                        </x-dropdown-link>
                                        
                                        <x-dropdown-link :href="url('emprendedor.business.index')" class="text-gray-300 hover:text-white">
                                            Mis Negocios
                                        </x-dropdown-link>
                                        
                                        <x-dropdown-link :href="url('emprendedor.products.index')" class="text-gray-300 hover:text-white">
                                            Productos
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="url('emprendedor.orders.index')" class="text-gray-300 hover:text-white">
                                            Pedidos
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="url('emprendedor.analytics')" class="text-gray-300 hover:text-white">
                                            Analytics
                                        </x-dropdown-link>
                                        
                                        <div class="border-t border-gray-700 mt-2 pt-2">
                                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-white">
                                                Mi Perfil
                                            </x-dropdown-link>
                                            
                                            <x-dropdown-link :href="url('emprendedor.settings')" class="text-gray-300 hover:text-white">
                                                Configuración
                                            </x-dropdown-link>
                                            
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
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