<x-cliente-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-white">
                    Detalle del Producto
                </h2>
                <p class="text-gray-400 text-sm">
                    Información completa del producto
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('cliente.productos.index') }}" 
                   class="inline-flex items-center glass-card border border-gray-600 hover:border-gray-500 text-gray-300 hover:text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver al Catálogo
                </a>
            </div>

            <div class="glass-card rounded-2xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
                    <!-- Product Images -->
                    <div class="space-y-4">
                        <!-- Main Image -->
                        <div class="bg-gray-800/30 rounded-2xl p-4 border border-gray-700/50">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-80 object-cover rounded-xl bg-gray-700">
                            @else
                                <div class="w-full h-80 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Store Info -->
                        <div class="glass-card rounded-xl p-4 border border-blue-500/20">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Vendido por</p>
                                    <p class="text-white font-semibold">{{ $product->business->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-6">
                        <!-- Product Header -->
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">{{ $product->name }}</h1>
                            
                            <!-- Status Badges -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @if($product->quantity == 0)
                                    <span class="inline-flex items-center px-3 py-1 bg-red-500/20 text-red-400 rounded-full text-sm font-medium">
                                        <span class="w-2 h-2 bg-red-400 rounded-full mr-2"></span>
                                        Agotado
                                    </span>
                                @elseif($product->quantity <= 5)
                                    <span class="inline-flex items-center px-3 py-1 bg-orange-500/20 text-orange-400 rounded-full text-sm font-medium">
                                        <span class="w-2 h-2 bg-orange-400 rounded-full mr-2"></span>
                                        Últimas {{ $product->quantity }} unidades
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm font-medium">
                                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                        En stock
                                    </span>
                                @endif
                            </div>

                            <!-- Price -->
                            <div class="flex items-baseline space-x-2 mb-4">
                                <span class="text-4xl font-bold text-white">${{ number_format($product->price, 0) }}</span>
                                <span class="text-gray-400 text-lg">COP</span>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($product->description)
                            <div class="space-y-3">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                    Descripción
                                </h3>
                                <p class="text-gray-300 leading-relaxed">{{ $product->description }}</p>
                            </div>
                        @endif

                        <!-- Product Actions -->
                        <div class="space-y-4 pt-6 border-t border-gray-700/50">
                            <!-- Quantity Selector -->
                            <div class="flex items-center justify-between">
                                <span class="text-white font-medium">Cantidad</span>
                                <div class="flex items-center space-x-3">
                                    <button class="w-10 h-10 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    <span class="text-white font-semibold text-lg w-8 text-center">1</span>
                                    <button class="w-10 h-10 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <button class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white py-4 rounded-xl transition-all duration-300 hover-glow font-semibold flex items-center justify-center group disabled:opacity-50 disabled:cursor-not-allowed"
                                        {{ $product->quantity == 0 ? 'disabled' : '' }}>
                                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Agregar al Carrito
                                </button>

                                <button class="w-full glass-card border-2 border-green-600 hover:border-green-500 text-green-400 hover:text-green-300 py-4 rounded-xl transition-all duration-300 font-semibold flex items-center justify-center group disabled:opacity-50 disabled:cursor-not-allowed"
                                        {{ $product->quantity == 0 ? 'disabled' : '' }}>
                                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    Comprar Ahora
                                </button>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="glass-card rounded-xl p-4 border border-gray-700/50">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="text-center">
                                    <div class="text-green-400 font-semibold">🛡️</div>
                                    <div class="text-white font-medium">Garantía</div>
                                    <div class="text-gray-400">30 días</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-blue-400 font-semibold">🚚</div>
                                    <div class="text-white font-medium">Envío</div>
                                    <div class="text-gray-400">Gratis</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cliente-layout>