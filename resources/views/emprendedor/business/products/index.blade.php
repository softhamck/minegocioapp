<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-white">
                    Productos de {{ $business->name }}
                </h2>
                <p class="text-gray-400 text-sm">
                    Gestiona el catálogo de productos de tu negocio
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                <div class="mb-4 sm:mb-0">
                    <a href="{{ route('emprendedor.business.index') }}" 
                       class="inline-flex items-center glass-card border border-gray-600 hover:border-gray-500 text-gray-300 hover:text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium group mb-4">
                        <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver a Negocios
                    </a>
                </div>
                
                <a href="{{ route('emprendedor.business.products.create', $business) }}"
                   class="inline-flex items-center bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-6 py-3 rounded-xl transition-all duration-300 hover-glow font-semibold group">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Agregar Producto
                </a>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-8">
                <div class="glass-card rounded-xl p-4 text-center border border-blue-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $products->count() }}</div>
                    <div class="text-blue-400 text-sm font-medium">Total Productos</div>
                </div>
                <div class="glass-card rounded-xl p-4 text-center border border-green-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $products->where('active', 1)->count() }}</div>
                    <div class="text-green-400 text-sm font-medium">Activos</div>
                </div>
                <div class="glass-card rounded-xl p-4 text-center border border-orange-500/20">
                    <div class="text-2xl font-bold text-white mb-1">{{ $products->where('active', 0)->count() }}</div>
                    <div class="text-orange-400 text-sm font-medium">Inactivos</div>
                </div>
                <div class="glass-card rounded-xl p-4 text-center border border-purple-500/20">
                    <div class="text-2xl font-bold text-white mb-1">${{ number_format($products->sum('price'), 0) }}</div>
                    <div class="text-purple-400 text-sm font-medium">Valor Total</div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="glass-card rounded-2xl overflow-hidden">
                @if($products->isEmpty())
                    <!-- Empty State -->
                    <div class="text-center py-12 px-6">
                        <div class="w-24 h-24 bg-gradient-to-r from-gray-600 to-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">No hay productos aún</h3>
                        <p class="text-gray-400 mb-6">Comienza agregando tu primer producto al catálogo</p>
                        <a href="{{ route('emprendedor.business.products.create', $business) }}"
                           class="inline-flex items-center bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-8 py-3 rounded-xl transition-all duration-300 hover-glow font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Crear Primer Producto
                        </a>
                    </div>
                @else
                    <!-- Products Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-700/50">
                                    <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Producto</th>
                                    <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Precio</th>
                                    <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Stock</th>
                                    <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Estado</th>
                                    <th class="text-right py-4 px-6 text-gray-400 font-semibold text-sm">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="border-b border-gray-700/30 hover:bg-gray-800/20 transition-colors duration-200">
                                        <!-- Product Info -->
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0">
                                                    @if($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                             class="w-12 h-12 object-cover rounded-lg bg-gray-700">
                                                    @else
                                                        <div class="w-12 h-12 bg-gradient-to-r from-gray-600 to-gray-700 rounded-lg flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-white">{{ $product->name }}</div>
                                                    @if($product->description)
                                                        <div class="text-gray-400 text-sm line-clamp-1">{{ Str::limit($product->description, 50) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Price -->
                                        <td class="py-4 px-6">
                                            <div class="text-white font-semibold">${{ number_format($product->price, 0) }}</div>
                                        </td>

                                        <!-- Quantity -->
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                <span class="text-white font-medium">{{ $product->quantity }}</span>
                                                @if($product->quantity == 0)
                                                    <span class="ml-2 px-2 py-1 bg-red-500/20 text-red-400 text-xs rounded-full">Sin stock</span>
                                                @elseif($product->quantity <= 5)
                                                    <span class="ml-2 px-2 py-1 bg-orange-500/20 text-orange-400 text-xs rounded-full">Bajo stock</span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Status -->
                                        <td class="py-4 px-6">
                                            @if($product->active == 1)
                                                <span class="inline-flex items-center px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm font-medium">
                                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                                    Activo
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-red-500/20 text-red-400 rounded-full text-sm font-medium">
                                                    <span class="w-2 h-2 bg-red-400 rounded-full mr-2"></span>
                                                    Inactivo
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Actions -->
                                        <td class="py-4 px-6">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('emprendedor.business.products.edit', [$business, $product]) }}"
                                                   class="inline-flex items-center p-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 hover:text-blue-300 rounded-lg transition-all duration-200 group"
                                                   title="Editar producto">
                                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>

                                                <form action="{{ route('emprendedor.business.products.destroy', [$business, $product]) }}"
                                                      method="POST" class="inline-block"
                                                      onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center p-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 hover:text-red-300 rounded-lg transition-all duration-200 group"
                                                            title="Eliminar producto">
                                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-emprendedor-layout>