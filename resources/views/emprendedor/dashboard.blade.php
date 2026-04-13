<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">Panel del Emprendedor</h2>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <!-- Decorative blur -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <!-- Welcome Section -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 sm:p-8 mb-8 shadow-[0_20px_60px_rgba(124,58,237,0.10)] backdrop-blur-xl">
                <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 rounded-full bg-[#FCE7F3] px-4 py-2 text-sm font-medium text-[#BE185D] mb-4">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#F472B6]"></span>
                            Tu espacio de trabajo
                        </div>

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-[#1F2937] mb-3">
                            ¡Bienvenido, {{ Auth::user()->name }}! 🚀
                        </h1>

                        <p class="text-[#6B7280] text-base sm:text-lg leading-7 mb-4 max-w-2xl">
                            Gestiona tu negocio, administra tus productos y haz crecer tu emprendimiento
                            con herramientas claras y modernas.
                        </p>

                        <div class="flex flex-wrap gap-2">
                            <span class="rounded-full bg-[#F3E8FF] px-3 py-1 text-sm font-semibold text-[#7C3AED]">
                                💼 Emprendedor
                            </span>
                            <span class="rounded-full bg-white px-3 py-1 text-sm font-medium text-[#6B7280] border border-[#E9D5FF]">
                                📈 Negocio Activo
                            </span>
                            @if($businessCount > 0)
                            <span class="rounded-full bg-gradient-to-r from-[#7C3AED]/20 to-[#F472B6]/20 px-3 py-1 text-sm font-medium text-[#7C3AED] border border-[#E9D5FF]">
                                🏪 {{ $businessCount }} Negocio(s)
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="sm:ml-6">
                        <div class="flex h-20 w-20 items-center justify-center rounded-[1.75rem] bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_16px_40px_rgba(124,58,237,0.22)]">
                            <span class="text-white text-2xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
                <!-- Mis Negocios -->
                <a href="{{ url('emprendedor/business') }}"
                   class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)]">
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-md transition duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-extrabold text-[#1F2937]">{{ $businessCount }}</div>
                            <div class="text-sm font-medium text-blue-500">Activos</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Mis Negocios</h3>
                    <p class="text-sm leading-6 text-[#6B7280]">Gestiona tus establecimientos</p>
                </a>

                <!-- Productos -->
                <a href="{{ url('emprendedor/products') }}"
                   class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)]">
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-md transition duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-extrabold text-[#1F2937]">{{ $productCount }}</div>
                            <div class="text-sm font-medium text-green-500">En catálogo</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Productos</h3>
                    <p class="text-sm leading-6 text-[#6B7280]">Total de productos activos</p>
                </a>

                <!-- Pedidos -->
                <a href="{{ url('emprendedor/orders') }}"
                   class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)]">
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-r from-[#7C3AED] to-[#F472B6] text-white shadow-md transition duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-extrabold text-[#1F2937]">{{ $orderCount }}</div>
                            <div class="text-sm font-medium text-[#7C3AED]">Activos: {{ $pendingOrders ?? $orderCount }}</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Pedidos</h3>
                    <p class="text-sm leading-6 text-[#6B7280]">Total de pedidos recibidos</p>
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 mb-8 shadow-[0_20px_60px_rgba(124,58,237,0.10)] backdrop-blur-xl">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-[#1F2937]">Gestión Rápida</h3>
                        <p class="text-sm text-[#6B7280] mt-1">Acciones principales para tu negocio</p>
                    </div>
                    <span class="text-sm font-medium text-[#7C3AED]">
                        Acceso directo
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Gestionar Negocios -->
                    <a href="{{ url('emprendedor/business') }}"
                       class="group rounded-[1.5rem] border border-[#E9D5FF] bg-white/85 p-5 text-center transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(124,58,237,0.10)]">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-lg transition duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-[#1F2937] mb-1">Mis Negocios</h4>
                        <p class="text-xs leading-5 text-[#6B7280]">Gestiona establecimientos</p>
                    </a>

                    <!-- Productos -->
                    <a href="{{ url('emprendedor/products') }}"
                       class="group rounded-[1.5rem] border border-[#E9D5FF] bg-white/85 p-5 text-center transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(124,58,237,0.10)]">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-lg transition duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-[#1F2937] mb-1">Productos</h4>
                        <p class="text-xs leading-5 text-[#6B7280]">Administra tu catálogo</p>
                    </a>

                    <!-- Pedidos -->
                    <a href="{{ url('emprendedor/orders') }}"
                       class="group rounded-[1.5rem] border border-[#E9D5FF] bg-white/85 p-5 text-center transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(124,58,237,0.10)]">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-[#7C3AED] to-[#F472B6] text-white shadow-lg transition duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-[#1F2937] mb-1">Pedidos</h4>
                        <p class="text-xs leading-5 text-[#6B7280]">Revisa y gestiona pedidos</p>
                    </a>

                    <!-- Analytics (Próximamente) -->
                    <div class="rounded-[1.5rem] border border-[#E9D5FF] bg-white/85 p-5 text-center opacity-70 cursor-not-allowed">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-[#F472B6] to-rose-500 text-white shadow-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-[#1F2937] mb-1">Análisis</h4>
                        <p class="text-xs leading-5 text-[#6B7280]">Próximamente</p>
                    </div>
                </div>
            </div>

            <!-- Consejos Section -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-[0_20px_60px_rgba(124,58,237,0.10)] backdrop-blur-xl">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-[#1F2937]">Consejos para tu negocio</h3>
                        <p class="text-sm text-[#6B7280] mt-1">Mejora tu presencia y ventas</p>
                    </div>
                    <span class="text-sm text-[#6B7280]">Tips destacados</span>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center rounded-2xl border border-[#EEF2FF] bg-white/85 p-4">
                        <div class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#F3E8FF] text-[#7C3AED]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#1F2937]">Completa la información de tu negocio</p>
                            <p class="text-sm text-[#6B7280]">Agrega logo, descripción y horarios para atraer más clientes.</p>
                        </div>
                    </div>

                    <div class="flex items-center rounded-2xl border border-[#EEF2FF] bg-white/85 p-4">
                        <div class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#FCE7F3] text-[#F472B6]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#1F2937]">Mantén tu catálogo actualizado</p>
                            <p class="text-sm text-[#6B7280]">Productos con fotos y descripciones claras venden más.</p>
                        </div>
                    </div>

                    <div class="flex items-center rounded-2xl border border-dashed border-[#E9D5FF] bg-white/60 p-4">
                        <div class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#E9D5FF] text-[#7C3AED]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#1F2937]">Próximamente: Reportes detallados</p>
                            <p class="text-sm text-[#6B7280]">Visualiza tus ventas y crecimiento con métricas avanzadas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-emprendedor-layout>