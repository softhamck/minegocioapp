<x-cliente-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-white">
                    Nuestras Tiendas
                </h2>
                <p class="text-gray-400 text-sm">
                    Descubre emprendimientos increíbles
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="glass-card rounded-xl p-4 text-center border border-blue-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $stores->count() }}</div>
                    <div class="text-blue-400 text-sm font-medium">Tiendas Activas</div>
                </div>
                <div class="glass-card rounded-xl p-4 text-center border border-purple-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $totalProducts ?? '0' }}</div>
                    <div class="text-purple-400 text-sm font-medium">Productos Totales</div>
                </div>
                <div class="glass-card rounded-xl p-4 text-center border border-green-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $categories->count() ?? '0' }}</div>
                    <div class="text-green-400 text-sm font-medium">Categorías</div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="relative max-w-2xl mx-auto">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        placeholder="Buscar tiendas por nombre..."
                        class="w-full bg-gray-900/50 border-2 border-gray-600 text-white placeholder-gray-500 rounded-xl pl-10 pr-4 py-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-200"
                    >
                </div>
            </div>

            <!-- Stores Grid -->
            @if($stores->isEmpty())
                <!-- Empty State -->
                <div class="glass-card rounded-2xl p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-600 to-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">No hay tiendas disponibles</h3>
                    <p class="text-gray-400">Pronto tendremos nuevas tiendas para ti</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($stores as $store)
                        <div class="glass-card rounded-2xl p-6 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-blue-500/30 hover:transform hover:-translate-y-2">
                            <!-- Store Header -->
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-white text-lg group-hover:text-blue-400 transition-colors line-clamp-2 mb-1">
                                        {{ $store->name }}
                                    </h3>
                                    @if($store->category)
                                        <span class="inline-block bg-blue-500/20 text-blue-400 text-xs px-2 py-1 rounded-full">
                                            {{ $store->category }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Store Description -->
                            @if($store->description)
                                <p class="text-gray-300 text-sm mb-4 line-clamp-3 leading-relaxed">
                                    {{ $store->description }}
                                </p>
                            @endif

                            <!-- Store Stats -->
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="text-center p-2 bg-gray-800/50 rounded-lg">
                                    <div class="text-white font-bold text-sm">{{ $store->products_count ?? '0' }}</div>
                                    <div class="text-gray-400 text-xs">Productos</div>
                                </div>
                                <div class="text-center p-2 bg-gray-800/50 rounded-lg">
                                    <div class="text-white font-bold text-sm">4.8</div>
                                    <div class="text-gray-400 text-xs">⭐ Rating</div>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            @if($store->telephone || $store->address)
                                <div class="space-y-2 mb-4">
                                    @if($store->telephone)
                                        <div class="flex items-center text-gray-400 text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            {{ $store->telephone }}
                                        </div>
                                    @endif
                                    @if($store->address)
                                        <div class="flex items-center text-gray-400 text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span class="line-clamp-1">{{ $store->address }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- Action Button -->
                            <a href="{{ route('cliente.tiendas.show', $store->id) }}"
                               class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white text-center py-3 rounded-xl transition-all duration-300 font-semibold flex items-center justify-center group/btn">
                                <svg class="w-5 h-5 mr-2 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Ver Productos
                            </a>
                        </div>
                    @endforeach
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
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-cliente-layout>