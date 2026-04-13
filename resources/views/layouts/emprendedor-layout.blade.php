<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MiNegocioApp') }} - Emprendedor</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .emprendedor-bg {
                background:
                    radial-gradient(circle at top left, rgba(196, 181, 253, 0.28), transparent 28%),
                    radial-gradient(circle at bottom right, rgba(244, 114, 182, 0.16), transparent 30%),
                    linear-gradient(135deg, #FDF4FF 0%, #FCF7FF 45%, #FFF7FB 100%);
            }

            .nav-link-soft {
                color: #6B7280;
                transition: all .25s ease;
            }

            .nav-link-soft:hover {
                color: #7C3AED;
                background: rgba(255, 255, 255, 0.75);
            }

            .nav-link-active {
                color: #7C3AED !important;
                background: #F3E8FF !important;
                box-shadow: inset 0 0 0 1px rgba(196, 181, 253, 0.65);
            }

            .dropdown-content {
                z-index: 1000;
            }
        </style>
    </head>

    <body class="emprendedor-bg min-h-screen font-sans antialiased text-[#1F2937]">
        <div class="flex min-h-screen flex-col">

            <header class="sticky top-0 z-40 border-b border-white/60 bg-white/55 backdrop-blur-xl">
                <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between gap-4">

                        <!-- Brand -->
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_12px_30px_rgba(124,58,237,0.20)]">
                                <span class="text-sm font-bold text-white">M</span>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.30em] text-[#7C3AED]">
                                    MINEGOCIOPP
                                </p>
                                <div class="truncate text-[#1F2937] text-sm font-medium">
                                    {{ $header ?? 'Panel Emprendedor' }}
                                </div>
                            </div>
                        </div>

                        <!-- Desktop Navigation -->
                        <nav class="hidden items-center gap-2 sm:flex">
                            <x-nav-link
                                :href="route('emprendedor.dashboard')"
                                :active="request()->routeIs('emprendedor.dashboard')"
                                class="nav-link-soft rounded-full px-4 py-2 text-sm font-medium {{ request()->routeIs('emprendedor.dashboard') ? 'nav-link-active' : '' }}">
                                Dashboard
                            </x-nav-link>

                            <x-nav-link
                                :href="route('emprendedor.business.index')"
                                :active="request()->routeIs('emprendedor.business.*')"
                                class="nav-link-soft rounded-full px-4 py-2 text-sm font-medium {{ request()->routeIs('emprendedor.business.*') ? 'nav-link-active' : '' }}">
                                Mis Negocios
                            </x-nav-link>

                            <x-nav-link
                                :href="route('emprendedor.products.index')"
                                :active="request()->routeIs('emprendedor.products.*')"
                                class="nav-link-soft rounded-full px-4 py-2 text-sm font-medium {{ request()->routeIs('emprendedor.products.*') ? 'nav-link-active' : '' }}">
                                Productos
                            </x-nav-link>

                            <x-nav-link
                                :href="route('emprendedor.orders.index')"
                                :active="request()->routeIs('emprendedor.orders.*')"
                                class="nav-link-soft rounded-full px-4 py-2 text-sm font-medium {{ request()->routeIs('emprendedor.orders.*') ? 'nav-link-active' : '' }}">
                                Pedidos
                            </x-nav-link>

                            <!-- Dropdown usuario -->
                            <div class="relative ml-2 dropdown-content">
                                <x-dropdown align="right" width="56">
                                    <x-slot name="trigger">
                                        <button class="flex items-center gap-3 rounded-full border border-white/70 bg-white/75 px-3 py-2 text-sm font-medium text-[#4B5563] shadow-sm transition duration-200 hover:border-[#E9D5FF] hover:text-[#7C3AED] focus:outline-none">
                                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-sm">
                                                <span class="text-sm font-bold text-white">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </span>
                                            </div>

                                            <div class="hidden text-left lg:block">
                                                <p class="max-w-[120px] truncate text-sm font-semibold text-[#374151]">
                                                    {{ Auth::user()->name }}
                                                </p>
                                                <p class="text-xs text-[#9CA3AF]">
                                                    Emprendedor
                                                </p>
                                            </div>

                                            <svg class="h-4 w-4 text-[#9CA3AF]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.51a.75.75 0 01-1.08 0l-4.25-4.51a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="rounded-2xl border border-[#F3E8FF] bg-white p-2 shadow-[0_20px_50px_rgba(124,58,237,0.15)]">
                                            <div class="px-3 py-2">
                                                <p class="text-sm font-semibold text-[#1F2937]">{{ Auth::user()->name }}</p>
                                                <p class="text-xs text-[#9CA3AF]">Emprendedor</p>
                                            </div>

                                            <div class="my-2 border-t border-[#F3E8FF]"></div>

                                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center rounded-xl px-3 py-2 text-sm text-[#374151] hover:bg-[#F5F3FF] hover:text-[#7C3AED]">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                Mi perfil
                                            </x-dropdown-link>

                                            <div class="my-2 border-t border-[#F3E8FF]"></div>

                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center rounded-xl px-3 py-2 text-sm text-[#E11D48] hover:bg-[#FFF1F2] hover:text-[#BE123C]">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                    </svg>
                                                    Cerrar sesión
                                                </x-dropdown-link>
                                            </form>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </nav>

                        <!-- Mobile Menu -->
                        <div class="sm:hidden dropdown-content">
                            <x-dropdown align="right" width="64">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center justify-center rounded-full border border-white/70 bg-white/80 p-2 text-[#6B7280] shadow-sm transition hover:text-[#7C3AED] focus:outline-none">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="rounded-2xl border border-[#F3E8FF] bg-white/95 p-2 shadow-[0_18px_40px_rgba(124,58,237,0.12)] backdrop-blur-xl">
                                        <div class="px-3 py-2">
                                            <p class="text-sm font-semibold text-[#1F2937]">{{ Auth::user()->name }}</p>
                                            <p class="text-xs text-[#9CA3AF]">Emprendedor</p>
                                        </div>

                                        <div class="my-2 border-t border-[#F3E8FF]"></div>

                                        <x-dropdown-link :href="route('emprendedor.dashboard')" class="rounded-xl px-3 py-2 text-sm text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]">Dashboard</x-dropdown-link>
                                        <x-dropdown-link :href="route('emprendedor.business.index')" class="rounded-xl px-3 py-2 text-sm text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]">Mis Negocios</x-dropdown-link>
                                        <x-dropdown-link :href="route('emprendedor.products.index')" class="rounded-xl px-3 py-2 text-sm text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]">Productos</x-dropdown-link>
                                        <x-dropdown-link :href="route('emprendedor.orders.index')" class="rounded-xl px-3 py-2 text-sm text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]">Pedidos</x-dropdown-link>

                                        <x-dropdown-link :href="route('profile.edit')" class="rounded-xl px-3 py-2 text-sm text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]">Mi perfil</x-dropdown-link>

                                        <div class="my-2 border-t border-[#F3E8FF]"></div>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-xl px-3 py-2 text-sm text-[#E11D48] hover:bg-[#FFF1F2] hover:text-[#BE123C]">
                                                Cerrar sesión
                                            </x-dropdown-link>
                                        </form>
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </header>

            <main class="relative z-10 flex-1">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>