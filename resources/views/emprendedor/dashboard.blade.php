<x-emprendedor-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">
            Panel del Emprendedor
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Section -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-3">
                            ¡Bienvenido, {{ Auth::user()->name }}! 🚀
                        </h1>
                        <p class="text-gray-400 text-lg mb-4">
                            Gestiona tu negocio y haz crecer tu emprendimiento
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-orange-500/20 text-orange-300 text-sm px-3 py-1 rounded-full font-medium">
                                💼 Emprendedor
                            </span>
                            <span class="bg-green-500/20 text-green-300 text-sm px-3 py-1 rounded-full font-medium">
                                📈 Negocio Activo
                            </span>
                            @if($businessCount > 0)
                            <span class="bg-blue-500/20 text-blue-300 text-sm px-3 py-1 rounded-full font-medium">
                                🏪 {{ $businessCount }} Negocio(s)
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-amber-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="text-white text-xl font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
                <!-- Tarjeta: Negocios -->
                <a href="{{ url('emprendedor.business.index') }}" 
                   class="glass-card rounded-xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-blue-500/30 hover:transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-white">{{ $businessCount }}</div>
                            <div class="text-blue-400 text-sm font-medium">Tu negocio</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Mis Negocios</h3>
                    <p class="text-gray-400 text-sm">Gestiona tus establecimientos</p>
                </a>

                <!-- Tarjeta: Productos -->
                <a href="{{ url('emprendedor.products.index') }}" 
                   class="glass-card rounded-xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-green-500/30 hover:transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-white">{{ $productCount }}</div>
                            <div class="text-green-400 text-sm font-medium">En catálogo</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Productos</h3>
                    <p class="text-gray-400 text-sm">Total de productos activos</p>
                </a>

                <!-- Tarjeta: Pedidos -->
                <a href="{{ url('emprendedor.orders.index') }}" 
                   class="glass-card rounded-xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-purple-500/30 hover:transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-white">{{ $orderCount }}</div>
                            <div class="text-purple-400 text-sm font-medium">Activos: {{ $pendingOrders ?? $orderCount }}</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Pedidos</h3>
                    <p class="text-gray-400 text-sm">Total de pedidos recibidos</p>
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white">Gestión Rápida</h3>
                    <span class="text-orange-400 text-sm font-medium">Acciones principales</span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Gestionar Negocios -->
                    <a href="{{ url('emprendedor.business.index') }}" 
                       class="group glass-card rounded-xl p-5 text-center hover-glow transition-all duration-300 border border-blue-500/20 hover:border-blue-400/50 hover:transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-white mb-1">Mis Negocios</h4>
                        <p class="text-gray-400 text-xs">Gestiona establecimientos</p>
                    </a>

                    <!-- Productos -->
                    <a href="{{ url('emprendedor.products.index') }}" 
                       class="group glass-card rounded-xl p-5 text-center hover-glow transition-all duration-300 border border-green-500/20 hover:border-green-400/50 hover:transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-white mb-1">Productos</h4>
                        <p class="text-gray-400 text-xs">Catálogo completo</p>
                    </a>

                    <!-- Pedidos -->
                    <a href="{{ url('emprendedor.orders.index') }}" 
                       class="group glass-card rounded-xl p-5 text-center hover-glow transition-all duration-300 border border-purple-500/20 hover:border-purple-400/50 hover:transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-white mb-1">Pedidos</h4>
                        <p class="text-gray-400 text-xs">Gestionar pedidos</p>
                    </a>

                    <!-- Analytics -->
                    <a href="{{ url('emprendedor.analytics') }}" 
                       class="group glass-card rounded-xl p-5 text-center hover-glow transition-all duration-300 border border-orange-500/20 hover:border-orange-400/50 hover:transform hover:-translate-y-1">
                        <div class="w-14 h-14 bg-gradient-to-r from-orange-500 to-amber-500 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-white mb-1">Análisis</h4>
                        <p class="text-gray-400 text-xs">Métricas y reportes</p>
                    </a>
                </div>
            </div>

           
        </div>
    </div>
</x-emprendedor-layout>