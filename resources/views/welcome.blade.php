<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'MiNegocioApp') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
        
        <!-- Para dispositivos Apple -->
        <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .hero-gradient {
                background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            }
            .card-glass {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .hover-glow:hover {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
            }
            .feature-icon {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            }
        </style>
    </head>
    <body class="font-sans antialiased hero-gradient text-gray-100">
        <!-- Header -->
        <header class="w-full max-w-7xl mx-auto px-6 py-8">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg"></div>
                        <span class="text-xl font-bold text-white">MiNegocioApp</span>
                    </div>

                    <!-- Navigation -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all duration-300 hover-glow font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="px-6 py-2 text-gray-300 hover:text-white transition-colors duration-300 font-medium">
                                Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all duration-300 hover-glow font-medium">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            @endif
        </header>

        <!-- Hero Section -->
        <main class="min-h-screen flex items-center justify-center px-6">
            <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white leading-tight">
                        Potencia tu 
                        <span class="bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">
                            negocio
                        </span>
                        en línea
                    </h1>
                    
                    <p class="text-xl text-gray-300 leading-relaxed">
                        La plataforma todo en uno para emprendedores y clientes. 
                        Gestiona tu negocio, vende productos y conecta con tu audiencia 
                        en un solo lugar.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" 
                           class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl transition-all duration-300 hover-glow font-semibold text-center">
                            Comenzar Gratis
                        </a>
                        <a href="#features" 
                           class="px-8 py-4 border border-gray-600 hover:border-indigo-500 text-gray-300 hover:text-white rounded-xl transition-all duration-300 font-semibold text-center">
                            Conocer Más
                        </a>
                    </div>

                    <!-- Features List -->
                    <div class="grid grid-cols-2 gap-6 pt-8">
                        <div class="flex items-center space-x-3">
                            <div class="feature-icon w-8 h-8 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-300">Gestión fácil</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="feature-icon w-8 h-8 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-300">Ventas online</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="feature-icon w-8 h-8 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-300">Clientes felices</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="feature-icon w-8 h-8 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-300">Crecimiento</span>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Graphic -->
                <div class="relative">
                    <div class="card-glass rounded-2xl p-8 lg:p-12">
                        <div class="space-y-6">
                            <!-- Stats Cards -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-800/50 rounded-xl p-4 text-center">
                                    <div class="text-2xl font-bold text-white">500+</div>
                                    <div class="text-sm text-gray-400">Emprendedores</div>
                                </div>
                                <div class="bg-gray-800/50 rounded-xl p-4 text-center">
                                    <div class="text-2xl font-bold text-white">10K+</div>
                                    <div class="text-sm text-gray-400">Clientes</div>
                                </div>
                            </div>
                            
                            <!-- Feature Illustration -->
                            <div class="bg-gradient-to-br from-indigo-500/10 to-purple-500/10 rounded-xl p-6 border border-indigo-500/20">
                                <div class="text-center space-y-3">
                                    <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-white">Crecimiento Rápido</h3>
                                    <p class="text-sm text-gray-400">Impulsa tu negocio con nuestras herramientas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-purple-500 rounded-full opacity-20 animate-pulse"></div>
                    <div class="absolute -bottom-4 -left-4 w-6 h-6 bg-indigo-500 rounded-full opacity-30 animate-pulse delay-1000"></div>
                </div>
            </div>
        </main>
    </body>
</html>