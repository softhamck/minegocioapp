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
                    {{ $store->name }}
                </h2>
                <p class="text-gray-400 text-sm">
                    Catálogo completo de productos
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('cliente.tiendas.index') }}" 
                   class="inline-flex items-center glass-card border border-gray-600 hover:border-gray-500 text-gray-300 hover:text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a Tiendas
                </a>
            </div>

            <!-- Store Header -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Store Info -->
                    <div class="lg:col-span-2">
                        <h1 class="text-3xl font-bold text-white mb-3">{{ $store->name }}</h1>
                        
                        @if($store->description)
                            <p class="text-gray-300 leading-relaxed mb-4">{{ $store->description }}</p>
                        @endif

                        <!-- Store Stats -->
                        <div class="flex flex-wrap gap-4">
                            <div class="flex items-center text-white">
                                <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold">Tienda Verificada</span>
                            </div>
                            <div class="flex items-center text-white">
                                <svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                <span class="font-semibold">4.8 ⭐ (125 reviews)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-3">
                        @if($store->telephone)
                            <div class="flex items-center text-white p-3 bg-blue-500/10 rounded-xl border border-blue-500/20">
                                <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="font-medium">{{ $store->telephone }}</span>
                            </div>
                        @endif
                        
                        @if($store->address)
                            <div class="flex items-center text-white p-3 bg-green-500/10 rounded-xl border border-green-500/20">
                                <svg class="w-5 h-5 mr-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-medium">{{ $store->address }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Productos de la Tienda
                    <span class="ml-2 bg-purple-500/20 text-purple-400 text-sm px-3 py-1 rounded-full">
                        {{ $products->count() }} productos
                    </span>
                </h3>
            </div>

            <!-- Products Grid -->
            @if($products->isEmpty())
                <div class="glass-card rounded-2xl p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-600 to-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">No hay productos disponibles</h3>
                    <p class="text-gray-400">Esta tienda aún no tiene productos publicados</p>
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
            @endif
        </div>
    </div>
</x-cliente-layout>