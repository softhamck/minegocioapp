<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'MiNegocioApp') }}</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased font-[Figtree] text-[#1F2937] bg-[#FDF4FF]">
        <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.35),_transparent_30%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.18),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)]">

            <!-- decorative blur -->
            <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/40 blur-3xl"></div>
            <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/20 blur-3xl"></div>
            <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/40 blur-3xl"></div>

            <!-- Header -->
            <header class="relative z-20 mx-auto w-full max-w-7xl px-6 py-8">
                @if (Route::has('login'))
                    <nav class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_12px_30px_rgba(124,58,237,0.22)]">
                                <span class="text-lg font-bold text-white">M</span>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.32em] text-[#7C3AED]">
                                    MiNegocioApp
                                </p>
                                <p class="text-sm font-medium text-[#6B7280]">
                                    para mujeres emprendedoras
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                   class="rounded-full bg-[#7C3AED] px-5 py-2.5 text-sm font-semibold text-white shadow-[0_12px_30px_rgba(124,58,237,0.25)] transition duration-300 hover:-translate-y-0.5 hover:bg-[#6D28D9]">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="rounded-full px-4 py-2 text-sm font-medium text-[#6B7280] transition duration-300 hover:bg-white/60 hover:text-[#7C3AED]">
                                    Iniciar Sesión
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="rounded-full bg-[#F472B6] px-5 py-2.5 text-sm font-semibold text-white shadow-[0_12px_30px_rgba(244,114,182,0.28)] transition duration-300 hover:-translate-y-0.5 hover:bg-[#EC4899]">
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </nav>
                @endif
            </header>

            <!-- Hero -->
            <main class="relative z-10 mx-auto max-w-7xl px-6 pb-20 pt-8 lg:pt-10">
                <div class="grid min-h-[82vh] items-center gap-14 lg:grid-cols-2">

                    <!-- Left -->
                    <section class="relative">
                        <div class="mb-7 inline-flex items-center gap-2 rounded-full border border-[#F3E8FF] bg-white/70 px-4 py-2 text-sm font-medium text-[#A21CAF] backdrop-blur">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#F472B6] shadow-[0_0_0_4px_rgba(244,114,182,0.15)]"></span>
                            Diseñado para mujeres que crean, lideran y crecen
                        </div>

                        <h1 class="max-w-2xl text-5xl font-extrabold leading-[0.98] tracking-tight text-[#1F2937] md:text-6xl lg:text-7xl">
                            Haz crecer tu negocio con una imagen
                            <span class="bg-gradient-to-r from-[#7C3AED] via-[#A855F7] to-[#F472B6] bg-clip-text text-transparent">
                                elegante, suave y poderosa
                            </span>
                        </h1>

                        <p class="mt-7 max-w-xl text-lg leading-8 text-[#6B7280] md:text-xl">
                            Organiza tus ventas, conecta con tus clientes y presenta tu marca con una experiencia
                            visual más femenina, moderna y profesional desde el primer vistazo.
                        </p>

                        <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-8 py-4 text-center font-semibold text-white shadow-[0_16px_40px_rgba(124,58,237,0.28)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(124,58,237,0.34)]">
                                    Empieza hoy
                                </a>
                            @endif

                            <a href="#beneficios"
                               class="rounded-full border border-[#E9D5FF] bg-white/80 px-8 py-4 text-center font-semibold text-[#374151] backdrop-blur transition duration-300 hover:border-[#C4B5FD] hover:bg-white">
                                Ver beneficios
                            </a>
                        </div>

                        <div class="mt-12 grid gap-4 sm:grid-cols-2" id="beneficios">
                            <div class="group rounded-2xl border border-white/60 bg-white/70 p-4 backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(124,58,237,0.10)]">
                                <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] to-[#C4B5FD] text-white">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-[#1F2937]">Gestión clara</p>
                                <p class="mt-1 text-sm text-[#6B7280]">Todo más simple y visual para tu día a día.</p>
                            </div>

                            <div class="group rounded-2xl border border-white/60 bg-white/70 p-4 backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(124,58,237,0.10)]">
                                <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-[#F472B6] to-[#C4B5FD] text-white">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-[#1F2937]">Ventas digitales</p>
                                <p class="mt-1 text-sm text-[#6B7280]">Impulsa tus ingresos con una presencia atractiva.</p>
                            </div>

                            <div class="group rounded-2xl border border-white/60 bg-white/70 p-4 backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(124,58,237,0.10)]">
                                <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-[#A78BFA] to-[#F472B6] text-white">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-[#1F2937]">Clientes felices</p>
                                <p class="mt-1 text-sm text-[#6B7280]">Genera confianza con una imagen delicada y profesional.</p>
                            </div>

                            <div class="group rounded-2xl border border-white/60 bg-white/70 p-4 backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(124,58,237,0.10)]">
                                <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] to-[#F472B6] text-white">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-[#1F2937]">Crecimiento real</p>
                                <p class="mt-1 text-sm text-[#6B7280]">Una experiencia pensada para vender mejor y escalar.</p>
                            </div>
                        </div>
                    </section>

                    <!-- Right -->
                    <section class="relative">
                        <div class="relative overflow-hidden rounded-[2rem] border border-white/70 bg-white/65 p-6 shadow-[0_20px_60px_rgba(124,58,237,0.12)] backdrop-blur-xl md:p-8 lg:p-10">
                            <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(255,255,255,0.45),rgba(255,255,255,0.08))]"></div>
                            <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#E9D5FF]/70 blur-2xl"></div>
                            <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#FBCFE8]/70 blur-2xl"></div>

                            <div class="relative">
                                <div class="mb-5 inline-flex items-center rounded-full bg-[#FCE7F3] px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-[#BE185D]">
                                    Bienvenida
                                </div>

                                <h2 class="max-w-sm text-3xl font-bold leading-tight text-[#1F2937] md:text-4xl">
                                    Una plataforma bonita también puede vender más
                                </h2>

                                <p class="mt-4 max-w-md text-base leading-7 text-[#6B7280]">
                                    Convierte tu presencia digital en una experiencia más cálida, confiable y memorable.
                                </p>

                                <div class="mt-8 space-y-4">
                                    <div class="rounded-[1.6rem] border border-[#F3E8FF] bg-white/90 p-5 shadow-sm">
                                        <div class="mb-3 flex items-center justify-between">
                                            <p class="text-sm font-medium text-[#6B7280]">Conexión rápida</p>
                                            <span class="rounded-full bg-[#F3E8FF] px-3 py-1 text-xs font-semibold text-[#7C3AED]">
                                                Activo
                                            </span>
                                        </div>
                                        <h3 class="text-2xl font-semibold text-[#1F2937]">Ventas digitales</h3>
                                        <p class="mt-2 text-sm leading-6 text-[#6B7280]">
                                            Presenta tus productos y servicios con una estética cuidada y atractiva.
                                        </p>
                                    </div>

                                    <div class="rounded-[1.6rem] border border-[#FCE7F3] bg-gradient-to-r from-white to-[#FFF1F7] p-5 shadow-sm">
                                        <div class="mb-3 flex items-center justify-between">
                                            <p class="text-sm font-medium text-[#6B7280]">Organización clara</p>
                                            <span class="rounded-full bg-[#FCE7F3] px-3 py-1 text-xs font-semibold text-[#DB2777]">
                                                Fluido
                                            </span>
                                        </div>
                                        <h3 class="text-2xl font-semibold text-[#1F2937]">Clientes felices</h3>
                                        <p class="mt-2 text-sm leading-6 text-[#6B7280]">
                                            Mejora la experiencia de tus clientas con una interfaz amable y profesional.
                                        </p>
                                    </div>

                                    <div class="rounded-[1.8rem] border border-[#E9D5FF] bg-gradient-to-r from-[#FAF5FF] via-[#FFF7FB] to-[#FDF2F8] p-6 shadow-[0_16px_40px_rgba(244,114,182,0.10)]">
                                        <div class="flex items-end justify-between gap-6">
                                            <div>
                                                <p class="text-sm font-medium text-[#6B7280]">Hazlo tuyo</p>
                                                <h3 class="mt-2 max-w-xs text-2xl font-semibold text-[#1F2937]">
                                                    Crea una marca delicada, firme y memorable
                                                </h3>
                                            </div>

                                            <div class="text-right">
                                                <p class="text-4xl font-extrabold bg-gradient-to-r from-[#7C3AED] to-[#F472B6] bg-clip-text text-transparent">
                                                    +80%
                                                </p>
                                                <p class="mt-1 text-sm text-[#6B7280]">
                                                    de emprendedoras conectan mejor
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 grid grid-cols-3 gap-3">
                                    <div class="rounded-2xl bg-white/80 p-4 text-center">
                                        <p class="text-2xl font-bold text-[#7C3AED]">24/7</p>
                                        <p class="mt-1 text-xs text-[#6B7280]">gestión</p>
                                    </div>
                                    <div class="rounded-2xl bg-white/80 p-4 text-center">
                                        <p class="text-2xl font-bold text-[#F472B6]">+95%</p>
                                        <p class="mt-1 text-xs text-[#6B7280]">claridad</p>
                                    </div>
                                    <div class="rounded-2xl bg-white/80 p-4 text-center">
                                        <p class="text-2xl font-bold text-[#7C3AED]">∞</p>
                                        <p class="mt-1 text-xs text-[#6B7280]">potencial</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>