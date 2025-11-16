<x-cliente-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">
            Panel del Cliente
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Section -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-3">
                            ¡Bienvenido, {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-gray-400 text-lg mb-4">
                            Gestiona tus compras y descubre nuevos productos
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-indigo-500/20 text-indigo-300 text-sm px-3 py-1 rounded-full font-medium">
                                🛍️ Comprador
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center">
                            <span class="text-white text-xl font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
                <!-- Tarjeta: Pedidos Realizados -->
                <a href="{{ url('cliente.pedidos.index') }}" 
                   class="glass-card rounded-xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-green-500/30 hover:transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-white">{{ $totalOrders ?? '0' }}</div>
                            <div class="text-green-400 text-sm font-medium">+5% este mes</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Pedidos Realizados</h3>
                    <p class="text-gray-400 text-sm">Compras completadas exitosamente</p>
                </a>

                <!-- Tarjeta: Pedidos Pendientes -->
                <a href="{{ url('cliente.pedidos.index') }}?status=pending" 
                   class="glass-card rounded-xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-yellow-500/30 hover:transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-amber-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-white">{{ $pendingOrders ?? '0' }}</div>
                            <div class="text-yellow-400 text-sm font-medium">En proceso</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Pedidos Pendientes</h3>
                    <p class="text-gray-400 text-sm">En camino o en preparación</p>
                </a>

                <!-- Tarjeta: Total Gastado -->
                <div class="glass-card rounded-xl p-6 border border-gray-700/50 hover:border-purple-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-white">${{ number_format($totalSpent ?? 0, 0) }}</div>
                            <div class="text-purple-400 text-sm font-medium">Total invertido</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Total Gastado</h3>
                    <p class="text-gray-400 text-sm">Inversión total en productos</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white">Acciones Rápidas</h3>
                    <span class="text-indigo-400 text-sm font-medium">Acceso directo</span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Explorar Productos -->
                    <a href="{{ url('cliente.productos.index') }}" 
                       class="group glass-card rounded-xl p-5 text-center hover-glow transition-all duration-300 border border-blue-500/20 hover:border-blue-400/50 hover:transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3-3H7"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-white mb-1">Explorar Productos</h4>
                        <p class="text-gray-400 text-xs">Descubre nuevos productos</p>
                    </a>

                    <!-- Mi Carrito -->
                    <a href="{{ url('cliente.carrito.index') }}" 
                       class="group glass-card rounded-xl p-5 text-center hover-glow transition-all duration-300 border border-green-500/20 hover:border-green-400/50 hover:transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg relative">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @if($cartCount ?? 0 > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </div>
                        <h4 class="font-semibold text-white mb-1">Mi Carrito</h4>
                        <p class="text-gray-400 text-xs">Revisa tus productos</p>
                    </a>

                    <!-- Mis Pedidos -->
                    <a href="{{ url('cliente.pedidos.index') }}" 
                       class="group glass-card rounded-xl p-5 text-center hover-glow transition-all duration-300 border border-indigo-500/20 hover:border-indigo-400/50 hover:transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-white mb-1">Mis Pedidos</h4>
                        <p class="text-gray-400 text-xs">Historial de compras</p>
                    </a>

                    <!-- Favoritos -->
                    <a href="{{ url('cliente.favoritos.index') }}" 
                       class="group glass-card rounded-xl p-5 text-center hover-glow transition-all duration-300 border border-pink-500/20 hover:border-pink-400/50 hover:transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-white mb-1">Favoritos</h4>
                        <p class="text-gray-400 text-xs">Productos guardados</p>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white">Actividad Reciente</h3>
                    <span class="text-gray-400 text-sm">Últimas acciones</span>
                </div>
                
                <div class="space-y-4">
                    <!-- Ejemplo de actividad -->
                    <div class="flex items-center p-4 bg-gray-800/30 rounded-lg border border-gray-700/50">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">Pedido completado</p>
                            <p class="text-gray-400 text-sm">Producto: Camiseta Premium</p>
                        </div>
                        <span class="text-green-400 text-sm font-medium">+$45.00</span>
                    </div>

                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-400 mb-2">No hay más actividad reciente</p>
                        <p class="text-gray-500 text-sm">Tu actividad aparecerá aquí</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cliente-layout>