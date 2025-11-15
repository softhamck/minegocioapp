<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">
            Panel Administrador
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Section -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">
                    Bienvenido, {{ Auth::user()->name }} 👋
                </h1>
                <p class="text-gray-400">Gestiona tu plataforma desde el panel de administración</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
                <!-- Tarjeta: Usuarios -->
                <a href="{{ route('admin.users.index') }}" 
                   class="glass-card rounded-xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-indigo-500/30">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-white">{{ $totalUsers ?? '0' }}</div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Usuarios Registrados</h3>
                    <p class="text-gray-400 text-sm">Ver y gestionar todos los usuarios</p>
                </a>

                <!-- Tarjeta: Pedidos -->
                <a href="{{ route('admin.orders.index') }}" 
                   class="glass-card rounded-xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-indigo-500/30">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-white">{{ $totalOrders ?? '0' }}</div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Pedidos Realizados</h3>
                    <p class="text-gray-400 text-sm">Monitorear el estado de pedidos</p>
                </a>

                <!-- Tarjeta: Productos -->
                <a href="{{ route('admin.products.index') }}" 
                   class="glass-card rounded-xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-indigo-500/30">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-white">{{ $totalProducts ?? '0' }}</div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Productos Publicados</h3>
                    <p class="text-gray-400 text-sm">Ver negocios y productos</p>
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="glass-card rounded-2xl p-6">
                <h3 class="text-lg font-bold text-white mb-4">Acciones Rápidas</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('admin.users.create') }}" 
                       class="flex items-center p-4 bg-indigo-600/20 border border-indigo-500/30 rounded-lg hover:bg-indigo-600/30 transition-colors group">
                        <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-white">Crear Usuario</div>
                            <div class="text-sm text-gray-400">Agregar nuevo usuario</div>
                        </div>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center p-4 bg-green-600/20 border border-green-500/30 rounded-lg hover:bg-green-600/30 transition-colors group">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-white">Reportes</div>
                            <div class="text-sm text-gray-400">Ver reportes del sistema</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>