<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Productos de {{ $business->name }}
                </h2>
                <p class="text-sm text-[#6B7280]">
                    Gestiona el catálogo de productos de tu negocio
                </p>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <!-- Decorative blur -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <!-- Header Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <a href="{{ route('emprendedor.business.index') }}" 
                       class="inline-flex items-center rounded-full border border-[#E9D5FF] bg-white/80 px-5 py-2.5 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] group">
                        <svg class="mr-2 h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver a Negocios
                    </a>
                </div>
                
                <a href="{{ route('emprendedor.business.products.create', $business) }}"
                   class="inline-flex items-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3 font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)] group">
                    <svg class="mr-2 h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Agregar Producto
                </a>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-8">
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)] text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $products->count() }}</div>
                    <div class="text-sm font-semibold text-[#7C3AED]">Total Productos</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)] text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $products->where('active', 1)->count() }}</div>
                    <div class="text-sm font-semibold text-[#EC4899]">Activos</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)] text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $products->where('active', 0)->count() }}</div>
                    <div class="text-sm font-semibold text-[#F59E0B]">Inactivos</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)] text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">${{ number_format($products->sum('price'), 0) }}</div>
                    <div class="text-sm font-semibold text-[#A855F7]">Valor Total</div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative">
                    @if($products->isEmpty())
                        <!-- Empty State -->
                        <div class="text-center py-12 px-6">
                            <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-[#7C3AED]/20 to-[#F472B6]/20">
                                <svg class="h-12 w-12 text-[#7C3AED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#1F2937] mb-2">No hay productos aún</h3>
                            <p class="text-[#6B7280] mb-6">Comienza agregando tu primer producto al catálogo</p>
                            <a href="{{ route('emprendedor.business.products.create', $business) }}"
                               class="inline-flex items-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-8 py-3 font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)]">
                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <tr class="border-b border-[#F3E8FF] bg-[#F5F3FF]/30">
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Producto</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Precio</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Stock</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Estado</th>
                                        <th class="px-6 py-4 text-right text-sm font-semibold text-[#374151]">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#F3E8FF]">
                                    @foreach ($products as $product)
                                        <tr class="hover:bg-[#FAF5FF]/50 transition-colors duration-200">
                                            <!-- Product Info -->
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-shrink-0">
                                                        @if($product->image)
                                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                                 class="h-12 w-12 rounded-lg object-cover bg-[#F3E8FF]">
                                                        @else
                                                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3]">
                                                                <svg class="h-6 w-6 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="font-semibold text-[#1F2937]">{{ $product->name }}</div>
                                                        @if($product->description)
                                                            <div class="text-sm text-[#6B7280] line-clamp-1">{{ Str::limit($product->description, 50) }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Price -->
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-[#1F2937]">${{ number_format($product->price, 0) }}</div>
                                                <div class="text-xs text-[#9CA3AF]">COP</div>
                                            </td>

                                            <!-- Quantity -->
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <span class="font-medium text-[#1F2937]">{{ $product->quantity }}</span>
                                                    @if($product->quantity == 0)
                                                        <span class="ml-2 rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-[#E11D48]">Sin stock</span>
                                                    @elseif($product->quantity <= 5)
                                                        <span class="ml-2 rounded-full bg-orange-100 px-2 py-0.5 text-xs font-medium text-orange-600">Bajo stock</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Status -->
                                            <td class="px-6 py-4">
                                                @if($product->active == 1)
                                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">
                                                        <span class="mr-1.5 h-2 w-2 rounded-full bg-green-600"></span>
                                                        Activo
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-700">
                                                        <span class="mr-1.5 h-2 w-2 rounded-full bg-red-600"></span>
                                                        Inactivo
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- Actions -->
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <a href="{{ route('emprendedor.business.products.edit', [$business, $product]) }}"
                                                       class="inline-flex items-center rounded-lg p-2 text-[#7C3AED] transition-all duration-200 hover:bg-[#F3E8FF] hover:text-[#6D28D9] group"
                                                       title="Editar producto">
                                                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </a>

                                                    <form action="{{ route('emprendedor.business.products.destroy', [$business, $product]) }}"
                                                          method="POST" class="inline-block"
                                                          onsubmit="return confirm('¿Estás segura de que quieres eliminar este producto?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center rounded-lg p-2 text-[#E11D48] transition-all duration-200 hover:bg-red-50 hover:text-[#BE123C] group"
                                                                title="Eliminar producto">
                                                            <svg class="h-4 w-4 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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