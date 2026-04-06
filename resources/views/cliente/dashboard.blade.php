<x-cliente-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-[#1F2937]">
            Panel del Cliente
        </h2>
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
                            Tu espacio personal
                        </div>

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-[#1F2937] mb-3">
                            ¡Bienvenida, {{ Auth::user()->name }}! 👋
                        </h1>

                        <p class="text-[#6B7280] text-base sm:text-lg leading-7 mb-4 max-w-2xl">
                            Gestiona tus compras, revisa tus pedidos y descubre nuevos productos
                            en una experiencia más clara, moderna y agradable.
                        </p>

                        <div class="flex flex-wrap gap-2">
                            <span class="rounded-full bg-[#F3E8FF] px-3 py-1 text-sm font-semibold text-[#7C3AED]">
                                🛍️ Compradora
                            </span>
                            <span class="rounded-full bg-white px-3 py-1 text-sm font-medium text-[#6B7280] border border-[#E9D5FF]">
                                Panel personalizado
                            </span>
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
                <!-- Pedidos Realizados -->
                <a href="{{ url('cliente.pedidos.index') }}"
                   class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)]">
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-r from-emerald-400 to-green-500 text-white shadow-md transition duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <div class="text-right">
                            <div class="text-3xl font-extrabold text-[#1F2937]">
                                {{ $totalOrders ?? '0' }}
                            </div>
                            <div class="text-sm font-medium text-emerald-500">
                                +5% este mes
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Pedidos realizados</h3>
                    <p class="text-sm leading-6 text-[#6B7280]">Compras completadas exitosamente.</p>
                </a>

                <!-- Pedidos Pendientes -->
                <a href="{{ url('cliente.pedidos.index') }}?status=pending"
                   class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)]">
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-r from-amber-400 to-yellow-500 text-white shadow-md transition duration-300 group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <div class="text-right">
                            <div class="text-3xl font-extrabold text-[#1F2937]">
                                {{ $pendingOrders ?? '0' }}
                            </div>
                            <div class="text-sm font-medium text-amber-500">
                                En proceso
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Pedidos pendientes</h3>
                    <p class="text-sm leading-6 text-[#6B7280]">Tus compras en preparación o en camino.</p>
                </a>

                <!-- Total Gastado -->
                <div class="rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)]">
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-r from-[#7C3AED] to-[#F472B6] text-white shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>

                        <div class="text-right">
                            <div class="text-3xl font-extrabold text-[#1F2937]">
                                ${{ number_format($totalSpent ?? 0, 0) }}
                            </div>
                            <div class="text-sm font-medium text-[#7C3AED]">
                                Total invertido
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Total gastado</h3>
                    <p class="text-sm leading-6 text-[#6B7280]">Tu inversión acumulada en productos.</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 mb-8 shadow-[0_20px_60px_rgba(124,58,237,0.10)] backdrop-blur-xl">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-[#1F2937]">Acciones rápidas</h3>
                        <p class="text-sm text-[#6B7280] mt-1">Accesos directos para moverte más fácil.</p>
                    </div>
                    <span class="text-sm font-medium text-[#7C3AED]">
                        Acceso directo
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Explorar Productos -->
                    <a href="{{ route('cliente.productos.index') }}"
                       class="group rounded-[1.5rem] border border-[#E9D5FF] bg-white/85 p-5 text-center transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(124,58,237,0.10)]">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-sky-400 to-cyan-500 text-white shadow-lg transition duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3-3H7"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-[#1F2937] mb-1">Explorar productos</h4>
                        <p class="text-xs leading-5 text-[#6B7280]">Descubre novedades y encuentra lo que necesitas.</p>
                    </a>

                    <!-- Mi Carrito -->
                    <a href="{{ url('cliente.carrito.index') }}"
                       class="group rounded-[1.5rem] border border-[#E9D5FF] bg-white/85 p-5 text-center transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(124,58,237,0.10)]">
                        <div class="relative mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-emerald-400 to-green-500 text-white shadow-lg transition duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @if($cartCount ?? 0 > 0)
                                <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-[#F43F5E] text-[10px] font-bold text-white shadow-md">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </div>
                        <h4 class="font-semibold text-[#1F2937] mb-1">Mi carrito</h4>
                        <p class="text-xs leading-5 text-[#6B7280]">Revisa y continúa con tus productos seleccionados.</p>
                    </a>

                    <!-- Mis Pedidos -->
                    <a href="{{ url('cliente.pedidos.index') }}"
                       class="group rounded-[1.5rem] border border-[#E9D5FF] bg-white/85 p-5 text-center transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(124,58,237,0.10)]">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-[#7C3AED] to-[#A855F7] text-white shadow-lg transition duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-[#1F2937] mb-1">Mis pedidos</h4>
                        <p class="text-xs leading-5 text-[#6B7280]">Consulta tu historial y el estado de tus compras.</p>
                    </a>

                    <!-- Favoritos -->
                    <a href="{{ url('cliente.favoritos.index') }}"
                       class="group rounded-[1.5rem] border border-[#E9D5FF] bg-white/85 p-5 text-center transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(124,58,237,0.10)]">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-[#F472B6] to-rose-500 text-white shadow-lg transition duration-300 group-hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-[#1F2937] mb-1">Favoritos</h4>
                        <p class="text-xs leading-5 text-[#6B7280]">Guarda productos para revisarlos después.</p>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 shadow-[0_20px_60px_rgba(124,58,237,0.10)] backdrop-blur-xl">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-[#1F2937]">Actividad reciente</h3>
                        <p class="text-sm text-[#6B7280] mt-1">Tus últimas acciones aparecerán aquí.</p>
                    </div>
                    <span class="text-sm text-[#6B7280]">Últimas acciones</span>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center rounded-2xl border border-[#EEF2FF] bg-white/85 p-4">
                        <div class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-sky-100 text-sky-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#1F2937]">Pedido completado</p>
                            <p class="text-sm text-[#6B7280]">Producto: Camiseta Premium</p>
                        </div>
                        <span class="text-sm font-semibold text-emerald-500">+$45.00</span>
                    </div>

                    <div class="rounded-[1.5rem] border border-dashed border-[#E9D5FF] bg-white/60 px-6 py-10 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-[#6B7280] mb-2 font-medium">No hay más actividad reciente</p>
                        <p class="text-sm text-[#9CA3AF]">Tu historial aparecerá aquí a medida que uses la plataforma.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cliente-layout>