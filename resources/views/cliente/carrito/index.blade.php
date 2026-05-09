<x-cliente-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Mi Carrito
                </h2>
                <p class="text-sm text-[#6B7280]">
                    Revisa y gestiona tus productos seleccionados
                </p>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <div class="relative z-10 max-w-6xl mx-auto">
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-300/60 bg-green-50/80 p-4 backdrop-blur">
                    <div class="flex items-center text-green-700">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-2xl border border-red-300/60 bg-red-50/80 p-4 backdrop-blur">
                    <div class="flex items-center text-red-700">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if(empty($cart))
                <!-- Carrito vacío -->
                <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 p-12 text-center backdrop-blur">
                    <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-[#7C3AED]/20 to-[#F472B6]/20">
                        <svg class="h-12 w-12 text-[#7C3AED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1F2937] mb-3">Tu carrito está vacío</h3>
                    <p class="text-[#6B7280] mb-6">¡Explora nuestros productos y agrega tus favoritos!</p>
                    <a href="{{ route('cliente.productos.index') }}" 
                       class="inline-flex items-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3 font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Explorar Productos
                    </a>
                </div>
            @else
                <!-- Carrito con productos -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Lista de Productos -->
                    <div class="lg:col-span-2">
                        <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                            <div class="relative">
                                <div class="overflow-x-auto">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="border-b border-[#F3E8FF] bg-[#F5F3FF]/30">
                                                <th class="px-4 py-3 text-left text-sm font-semibold text-[#374151]">Producto</th>
                                                <th class="px-4 py-3 text-center text-sm font-semibold text-[#374151]">Cantidad</th>
                                                <th class="px-4 py-3 text-right text-sm font-semibold text-[#374151]">Subtotal</th>
                                                <th class="px-4 py-3 text-center text-sm font-semibold text-[#374151]"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-[#F3E8FF]">
                                            @foreach($cart as $id => $item)
                                                <tr>
                                                    <td class="px-4 py-3">
                                                        <div class="flex items-center gap-3">
                                                            @if($item['image'] && Illuminate\Support\Facades\Storage::disk('public')->exists($item['image']))
                                                                <img src="{{ asset('storage/' . $item['image']) }}" class="h-12 w-12 rounded-lg object-cover">
                                                            @else
                                                                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3]">
                                                                    <svg class="h-6 w-6 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <p class="font-semibold text-[#1F2937]">{{ $item['name'] }}</p>
                                                                <p class="text-xs text-[#6B7280]">{{ $item['business_name'] ?? 'Negocio' }}</p>
                                                                <p class="text-sm text-[#7C3AED]">${{ number_format($item['price'], 0) }} c/u</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <form action="{{ route('cliente.carrito.update', $id) }}" method="POST" class="flex justify-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="flex items-center border border-[#F3E8FF] rounded-full bg-white/80">
                                                                <button type="button" onclick="decrementCartQuantity(this)" 
                                                                        class="rounded-l-full px-2 py-1 text-[#7C3AED] hover:bg-[#F3E8FF] transition-colors">
                                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                                    </svg>
                                                                </button>
                                                                <input type="number" 
                                                                       name="quantity" 
                                                                       value="{{ $item['quantity'] }}" 
                                                                       min="1"
                                                                       class="w-12 text-center border-0 bg-transparent py-1 text-[#1F2937] text-sm focus:outline-none">
                                                                <button type="button" onclick="incrementCartQuantity(this)" 
                                                                        class="rounded-r-full px-2 py-1 text-[#7C3AED] hover:bg-[#F3E8FF] transition-colors">
                                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td class="px-4 py-3 text-right font-semibold text-[#7C3AED]">
                                                        ${{ number_format($item['price'] * $item['quantity'], 0) }}
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <form action="{{ route('cliente.carrito.remove', $id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="rounded-lg p-2 text-[#E11D48] hover:bg-red-50 transition-colors" title="Eliminar">
                                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="border-t border-[#F3E8FF] p-4">
                                    <form action="{{ route('cliente.carrito.clear') }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition-colors">
                                            Vaciar Carrito
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resumen del Pedido -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24 relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                            <div class="relative p-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                                    <h3 class="text-lg font-bold text-[#1F2937]">Resumen del Pedido</h3>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-[#6B7280]">Subtotal</span>
                                        <span class="font-semibold text-[#1F2937]">${{ number_format($total, 0) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-[#6B7280]">Envío</span>
                                        <span class="font-semibold text-[#1F2937]">Por calcular</span>
                                    </div>
                                    <div class="border-t border-[#F3E8FF] pt-3">
                                        <div class="flex justify-between">
                                            <span class="text-lg font-bold text-[#1F2937]">Total</span>
                                            <span class="text-xl font-extrabold text-[#7C3AED]">${{ number_format($total, 0) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" class="mt-6 block w-full rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3 text-center font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)]">
                                    Proceder al Pago
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function decrementCartQuantity(btn) {
            const input = btn.parentElement.querySelector('input[name="quantity"]');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                input.form.submit();
            }
        }
        
        function incrementCartQuantity(btn) {
            const input = btn.parentElement.querySelector('input[name="quantity"]');
            const currentValue = parseInt(input.value);
            input.value = currentValue + 1;
            input.form.submit();
        }
    </script>
</x-cliente-layout>