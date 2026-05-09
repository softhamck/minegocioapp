<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Catálogo General
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <!-- Elementos decorativos (Blur) -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <!-- Tarjetas de Estadísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $products->total() }}</div>
                    <div class="text-sm font-semibold text-[#7C3AED]">Productos Totales</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-2xl font-extrabold text-[#1F2937] mb-1 truncate">${{ number_format($products->sum('price'), 0) }}</div>
                    <div class="text-sm font-semibold text-[#EC4899]">Valor Inventario</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $products->where('active', 1)->count() }}</div>
                    <div class="text-sm font-semibold text-[#F59E0B]">Productos Activos</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $products->where('quantity', '<=', 5)->count() }}</div>
                    <div class="text-sm font-semibold text-[#A855F7]">Stock Bajo (≤5)</div>
                </div>
            </div>

            <!-- Tabla de Productos -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-[#F3E8FF] bg-[#F5F3FF]/30">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Producto</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Negocio</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Precio</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Stock</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Estado</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-[#374151]">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F3E8FF]">
                            @forelse($products as $product)
                            <tr class="hover:bg-[#FAF5FF]/50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-[#6B7280]">{{ $product->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" class="h-10 w-10 rounded-lg object-cover bg-[#F3E8FF]">
                                        @else
                                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3]">
                                                <svg class="h-5 w-5 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-[#1F2937]">{{ $product->name }}</p>
                                            <p class="text-xs text-[#6B7280] line-clamp-1">{{ Str::limit($product->description ?? 'Sin descripción', 40) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#7C3AED] font-medium">{{ $product->business->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-[#1F2937]">${{ number_format($product->price, 0) }}</span>
                                    <span class="text-xs text-[#9CA3AF] ml-1">COP</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($product->quantity == 0)
                                        <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-700">Sin stock</span>
                                    @elseif($product->quantity <= 5)
                                        <span class="inline-flex items-center rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-medium text-orange-600">{{ $product->quantity }} uds.</span>
                                    @else
                                        <span class="text-sm text-[#6B7280]">{{ $product->quantity }} uds.</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($product->active == 1)
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Activo</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600">Inactivo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                                           class="rounded-lg p-2 text-[#7C3AED] hover:bg-[#F3E8FF] transition-colors" 
                                           title="Editar producto">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        
                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                              method="POST" 
                                              class="inline-block" 
                                              onsubmit="return confirm('¿Estás segura de que quieres eliminar este producto? Esta acción no se puede deshacer.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="rounded-lg p-2 text-[#E11D48] hover:bg-red-50 transition-colors" 
                                                    title="Eliminar producto">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-[#6B7280]">
                                    <svg class="mx-auto h-12 w-12 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <p class="mt-4 text-lg font-medium">No hay productos registrados</p>
                                    <p class="text-sm">Los productos que creen los emprendedores aparecerán aquí.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($products->hasPages())
                <div class="border-t border-[#F3E8FF] px-6 py-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>