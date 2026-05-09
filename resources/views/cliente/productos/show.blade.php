<x-cliente-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_12px_30px_rgba(124,58,237,0.22)]">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Detalle del Producto
                </h2>
                <p class="text-sm text-[#6B7280]">
                    Información completa del producto
                </p>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <!-- Elementos decorativos -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-6xl mx-auto">
            <!-- Botón volver -->
            <div class="mb-6">
                <a href="{{ url()->previous() }}" 
                   class="inline-flex items-center rounded-full border border-[#E9D5FF] bg-white/80 px-5 py-2.5 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] group">
                    <svg class="mr-2 h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver
                </a>
            </div>

            <!-- Product Detail Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 sm:p-8">
                    <!-- Imagen del Producto -->
                    <div class="flex items-center justify-center">
                        <div class="w-full max-w-md overflow-hidden rounded-2xl bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3] p-4">
                            @if($product->image && Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}"
                                     class="h-auto w-full rounded-xl object-cover shadow-lg">
                            @else
                                <div class="flex h-96 w-full items-center justify-center">
                                    <svg class="h-32 w-32 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Información del Producto -->
                    <div class="flex flex-col space-y-4">
                        <!-- Nombre y Negocio -->
                        <div>
                            <div class="mb-2 inline-flex items-center rounded-full bg-gradient-to-r from-[#7C3AED]/20 to-[#F472B6]/20 px-3 py-1 text-xs font-medium text-[#7C3AED]">
                                {{ $product->business->name ?? 'Negocio' }}
                            </div>
                            <h1 class="text-3xl font-extrabold text-[#1F2937]">{{ $product->name }}</h1>
                        </div>

                        <!-- Precio -->
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-extrabold text-[#7C3AED]">${{ number_format($product->price, 0) }}</span>
                            <span class="text-sm text-[#6B7280]">COP</span>
                        </div>

                        <!-- Descripción -->
                        @if($product->description)
                            <div class="border-t border-[#F3E8FF] pt-4">
                                <h3 class="mb-2 text-sm font-semibold uppercase tracking-wide text-[#6B7280]">Descripción</h3>
                                <p class="text-[#1F2937] leading-relaxed">{{ $product->description }}</p>
                            </div>
                        @endif

                        <!-- Stock -->
                        <div class="border-t border-[#F3E8FF] pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-[#6B7280]">Disponibilidad:</span>
                                @if($product->quantity > 0)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-sm font-medium text-green-700">
                                        <span class="mr-1 h-2 w-2 rounded-full bg-green-600"></span>
                                        {{ $product->quantity }} unidades disponibles
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-sm font-medium text-red-700">
                                        <span class="mr-1 h-2 w-2 rounded-full bg-red-600"></span>
                                        Agotado
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Formulario de Cantidad y Agregar al Carrito -->
                        @if($product->quantity > 0)
                            <form action="{{ route('cliente.carrito.add', $product->id) }}" method="POST" class="border-t border-[#F3E8FF] pt-4">
                            @csrf
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <div class="flex items-center gap-3">
                                        <label for="quantity" class="text-sm font-medium text-[#374151]">Cantidad:</label>
                                        <div class="flex items-center border border-[#F3E8FF] rounded-full bg-white/80">
                                            <button type="button" onclick="decrementQuantity()" 
                                                    class="rounded-l-full px-3 py-2 text-[#7C3AED] hover:bg-[#F3E8FF] transition-colors">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                            <input type="number" 
                                                name="quantity" 
                                                id="quantity"
                                                value="1" 
                                                min="1" 
                                                max="{{ $product->quantity }}"
                                                class="w-16 text-center border-0 bg-transparent py-2 text-[#1F2937] focus:outline-none">
                                            <button type="button" onclick="incrementQuantity()" 
                                                    class="rounded-r-full px-3 py-2 text-[#7C3AED] hover:bg-[#F3E8FF] transition-colors">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit" 
                                            class="flex-1 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3 font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)]">
                                        <svg class="mr-2 inline h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Agregar al Carrito
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="border-t border-[#F3E8FF] pt-4">
                                <button disabled 
                                        class="w-full rounded-full bg-gray-300 px-6 py-3 font-semibold text-white cursor-not-allowed">
                                    <svg class="mr-2 inline h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Producto Agotado
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Productos Relacionados -->
            @if($relatedProducts && $relatedProducts->count() > 0)
                <div class="mt-12">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-xl font-bold text-[#1F2937]">Productos Relacionados</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <div class="group rounded-2xl border border-white/60 bg-white/70 p-4 backdrop-blur transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(124,58,237,0.12)]">
                                <div class="relative mb-3 h-40 w-full overflow-hidden rounded-xl">
                                    @if($related->image && Illuminate\Support\Facades\Storage::disk('public')->exists($related->image))
                                        <img src="{{ asset('storage/' . $related->image) }}" 
                                             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3]">
                                            <svg class="h-10 w-10 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <h4 class="font-bold text-[#1F2937] line-clamp-1">{{ $related->name }}</h4>
                                <p class="text-xl font-extrabold text-[#7C3AED] mt-2">${{ number_format($related->price, 0) }}</p>
                                <a href="{{ route('cliente.productos.show', $related) }}" 
                                   class="mt-3 block w-full rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] py-2 text-center text-sm font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                                    Ver Detalle
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function decrementQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            const minValue = parseInt(input.min);
            if (currentValue > minValue) {
                input.value = currentValue - 1;
            }
        }
        
        function incrementQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            const maxValue = parseInt(input.max);
            if (currentValue < maxValue) {
                input.value = currentValue + 1;
            }
        }
    </script>

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-cliente-layout>