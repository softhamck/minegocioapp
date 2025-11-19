<x-cliente-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-white">
                    Catálogo de Productos
                </h2>
                <p class="text-gray-400 text-sm">
                    Descubre todos los productos disponibles
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="glass-card rounded-xl p-4 text-center border border-purple-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $products->count() }}</div>
                    <div class="text-purple-400 text-sm font-medium">Productos Totales</div>
                </div>
                <div class="glass-card rounded-xl p-4 text-center border border-blue-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $stores->count() ?? '0' }}</div>
                    <div class="text-blue-400 text-sm font-medium">Tiendas Activas</div>
                </div>
                <div class="glass-card rounded-xl p-4 text-center border border-green-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $categories->count() ?? '0' }}</div>
                    <div class="text-green-400 text-sm font-medium">Categorías</div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                placeholder="Buscar productos..."
                                class="w-full bg-gray-900/50 border-2 border-gray-600 text-white placeholder-gray-500 rounded-xl pl-10 pr-4 py-3 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all duration-200"
                            >
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-wrap gap-3">
                        <select class="bg-gray-900/50 border-2 border-gray-600 text-white rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-200 text-sm">
                            <option>Todas las tiendas</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>

                        <select class="bg-gray-900/50 border-2 border-gray-600 text-white rounded-xl px-4 py-3 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-200 text-sm">
                            <option>Ordenar por</option>
                            <option>Precio: Menor a Mayor</option>
                            <option>Precio: Mayor a Menor</option>
                            <option>Nombre A-Z</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            @if($products->isEmpty())
                <!-- Empty State -->
                <div class="glass-card rounded-2xl p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-600 to-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">No hay productos disponibles</h3>
                    <p class="text-gray-400 mb-6">Pronto tendremos nuevos productos para ti</p>
                    <a href="{{ route('cliente.tiendas.index') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white px-8 py-3 rounded-xl transition-all duration-300 hover-glow font-semibold">
                        Explorar Tiendas
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="glass-card rounded-2xl p-5 hover-glow transition-all duration-300 group border border-gray-700/50 hover:border-purple-500/30 hover:transform hover:-translate-y-2">
                            <!-- Product Image -->
                            <div class="relative mb-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-48 object-cover rounded-xl bg-gray-700 group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Store Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="bg-black/60 text-white text-xs px-2 py-1 rounded-full backdrop-blur-sm">
                                        {{ $product->business->name }}
                                    </span>
                                </div>

                                <!-- Stock Status -->
                                @if($product->quantity == 0)
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-red-500/90 text-white text-xs px-2 py-1 rounded-full backdrop-blur-sm">
                                            Agotado
                                        </span>
                                    </div>
                                @elseif($product->quantity <= 5)
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-orange-500/90 text-white text-xs px-2 py-1 rounded-full backdrop-blur-sm">
                                            Últimas unidades
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="space-y-3">
                                <h3 class="font-semibold text-white text-lg group-hover:text-purple-400 transition-colors line-clamp-2">
                                    {{ $product->name }}
                                </h3>

                                @if($product->description)
                                    <p class="text-gray-400 text-sm line-clamp-2 leading-relaxed">
                                        {{ $product->description }}
                                    </p>
                                @endif

                                <div class="flex items-center justify-between">
                                    <div class="text-2xl font-bold text-white">
                                        ${{ number_format($product->price, 0) }}
                                    </div>
                                    <span class="text-gray-500 text-sm">COP</span>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('cliente.productos.show', $product->id) }}"
                                   class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white text-center py-3 rounded-xl transition-all duration-300 font-semibold flex items-center justify-center group/btn">
                                    <svg class="w-5 h-5 mr-2 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Ver Detalle
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-8 glass-card rounded-2xl p-6">
                        <div class="flex items-center justify-between">
                            <div class="text-gray-400 text-sm">
                                Mostrando {{ $products->firstItem() }} - {{ $products->lastItem() }} de {{ $products->total() }} productos
                            </div>
                            <div class="flex space-x-2">
                                @if($products->onFirstPage())
                                    <span class="px-4 py-2 bg-gray-700 text-gray-500 rounded-xl cursor-not-allowed">
                                        Anterior
                                    </span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 glass-card border border-gray-600 hover:border-purple-500 text-gray-300 hover:text-white rounded-xl transition-all duration-300">
                                        Anterior
                                    </a>
                                @endif

                                @if($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 glass-card border border-gray-600 hover:border-purple-500 text-gray-300 hover:text-white rounded-xl transition-all duration-300">
                                        Siguiente
                                    </a>
                                @else
                                    <span class="px-4 py-2 bg-gray-700 text-gray-500 rounded-xl cursor-not-allowed">
                                        Siguiente
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
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
</x-cliente-layout>