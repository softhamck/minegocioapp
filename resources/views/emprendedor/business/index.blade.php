<x-emprendedor-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Mis Negocios
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">
                            Gestiona tus Negocios 🏪
                        </h1>
                        <p class="text-gray-400 text-lg">
                            Crea y administra todos tus establecimientos en un solo lugar
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('emprendedor.business.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold rounded-xl transition-all duration-300 hover-glow shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Crear Nuevo Negocio
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="glass-card rounded-xl p-6 text-center border border-blue-500/20">
                    <div class="text-3xl font-bold text-white mb-2">{{ $businesses->count() }}</div>
                    <div class="text-blue-400 font-semibold">Negocios Activos</div>
                </div>
                <div class="glass-card rounded-xl p-6 text-center border border-green-500/20">
                    <div class="text-3xl font-bold text-white mb-2">{{ $totalProducts ?? '0' }}</div>
                    <div class="text-green-400 font-semibold">Productos Totales</div>
                </div>
                <div class="glass-card rounded-xl p-6 text-center border border-purple-500/20">
                    <div class="text-3xl font-bold text-white mb-2">{{ $totalOrders ?? '0' }}</div>
                    <div class="text-purple-400 font-semibold">Pedidos Activos</div>
                </div>
            </div>

            <!-- Businesses Grid -->
            @if($businesses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($businesses as $business)
                        <div class="glass-card rounded-2xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-blue-500/30 hover:transform hover:-translate-y-1">
                            <!-- Business Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-white text-lg group-hover:text-blue-400 transition-colors">
                                            {{ $business->name }}
                                        </h3>
                                        <p class="text-gray-400 text-sm">{{ $business->category ?? 'Sin categoría' }}</p>
                                    </div>
                                </div>
                                <div class="relative dropdown-content">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="text-gray-400 hover:text-white transition-colors p-1 rounded-lg hover:bg-gray-700/50">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content" class="z-50">
                                            <x-dropdown-link href="{{ route('emprendedor.business.edit', $business) }}" class="text-gray-300 hover:text-white flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Editar
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('emprendedor.business.destroy', $business) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-400 hover:text-red-300 flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Eliminar
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>

                            <!-- Business Description -->
                            <p class="text-gray-300 text-sm mb-4 line-clamp-2">
                                {{ $business->description ?? 'Sin descripción disponible.' }}
                            </p>

                            <!-- Business Stats -->
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="text-center p-2 bg-gray-800/50 rounded-lg">
                                    <div class="text-white font-bold text-sm">{{ $business->products_count ?? '0' }}</div>
                                    <div class="text-gray-400 text-xs">Productos</div>
                                </div>
                                <div class="text-center p-2 bg-gray-800/50 rounded-lg">
                                    <div class="text-white font-bold text-sm">{{ $business->orders_count ?? '0' }}</div>
                                    <div class="text-gray-400 text-xs">Pedidos</div>
                                </div>
                                <div class="text-center p-2 bg-gray-800/50 rounded-lg">
                                    <div class="text-white font-bold text-sm">{{ $business->is_active ? 'Activo' : 'Inactivo' }}</div>
                                    <div class="text-gray-400 text-xs">Estado</div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('emprendedor.business.show', $business) }}" 
                                   class="flex-1 bg-blue-600/20 hover:bg-blue-600/30 text-blue-400 hover:text-blue-300 text-center py-2 px-3 rounded-lg text-sm font-medium transition-all duration-300 border border-blue-500/30 hover:border-blue-400/50">
                                    Ver Detalles
                                </a>
                                <a href="{{ route('emprendedor.products.index', ['business' => $business->id]) }}" 
                                   class="flex-1 bg-green-600/20 hover:bg-green-600/30 text-green-400 hover:text-green-300 text-center py-2 px-3 rounded-lg text-sm font-medium transition-all duration-300 border border-green-500/30 hover:border-green-400/50">
                                    Productos
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="glass-card rounded-2xl p-12 text-center border-2 border-dashed border-gray-600/50">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-600 to-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">No tienes negocios aún</h3>
                    <p class="text-gray-400 mb-6 max-w-md mx-auto">
                        Comienza creando tu primer negocio para gestionar productos, recibir pedidos y conectar con clientes.
                    </p>
                    <a href="{{ route('emprendedor.business.create') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold rounded-xl transition-all duration-300 hover-glow shadow-lg text-lg">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Crear mi Primer Negocio
                    </a>
                </div>
            @endif

           
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-emprendedor-layout> 