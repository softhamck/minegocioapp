<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Panel Administrador
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Section -->
            <div class="glass-soft rounded-2xl p-6 mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-[#1F2937] mb-2">
                    Bienvenido, {{ Auth::user()->name }} 👋
                </h1>
                <p class="text-[#6B7280]">Gestione tu plataforma desde el panel de administración</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('admin.users.index') }}" 
                   class="glass-soft rounded-xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(124,58,237,0.12)]">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-md">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                        <div class="text-3xl font-extrabold text-[#1F2937]">{{ $totalUsers ?? '0' }}</div>
                    </div>
                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Usuarios Registrados</h3>
                    <p class="text-sm text-[#6B7280]">Ver y gestionar todos los usuarios</p>
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                   class="glass-soft rounded-xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(124,58,237,0.12)]">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#EC4899] via-[#F472B6] to-[#FBCFE8] shadow-md">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div class="text-3xl font-extrabold text-[#1F2937]">{{ $totalOrders ?? '0' }}</div>
                    </div>
                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Pedidos Realizados</h3>
                    <p class="text-sm text-[#6B7280]">Monitorear el estado de pedidos</p>
                </a>

                <a href="{{ route('admin.products.index') }}" 
                   class="glass-soft rounded-xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(124,58,237,0.12)]">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#A855F7] via-[#C4B5FD] to-[#E9D5FF] shadow-md">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="text-3xl font-extrabold text-[#1F2937]">{{ $totalProducts ?? '0' }}</div>
                    </div>
                    <h3 class="text-lg font-bold text-[#1F2937] mb-2">Productos Publicados</h3>
                    <p class="text-sm text-[#6B7280]">Ver negocios y productos</p>
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="glass-soft rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                    <h3 class="text-lg font-bold text-[#1F2937]">Acciones Rápidas</h3>
                    <span class="text-xs text-[#6B7280] ml-2">Acceso directo</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('admin.users.create') }}" 
                       class="flex items-center p-4 rounded-xl bg-gradient-to-r from-[#7C3AED]/10 to-[#F472B6]/10 border border-[#C4B5FD]/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-md group">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-[#7C3AED] to-[#A78BFA] shadow-md transition-transform duration-300 group-hover:scale-110 mr-3">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-[#1F2937] group-hover:text-[#7C3AED] transition-colors">Crear Usuario</div>
                            <div class="text-sm text-[#6B7280]">Agregar nuevo usuario al sistema</div>
                        </div>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center p-4 rounded-xl bg-gradient-to-r from-[#EC4899]/10 to-[#F472B6]/10 border border-[#FBCFE8]/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-md group">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-[#EC4899] to-[#F472B6] shadow-md transition-transform duration-300 group-hover:scale-110 mr-3">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-[#1F2937] group-hover:text-[#EC4899] transition-colors">Reportes</div>
                            <div class="text-sm text-[#6B7280]">Ver reportes del sistema</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>