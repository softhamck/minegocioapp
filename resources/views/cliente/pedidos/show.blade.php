<x-cliente-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_12px_30px_rgba(124,58,237,0.22)]">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Pedido #{{ $order->id }}
                </h2>
                <p class="text-sm text-[#6B7280]">
                    Detalle completo de tu pedido
                </p>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <div class="relative z-10 max-w-5xl mx-auto">
            <!-- Botón volver -->
            <div class="mb-6">
                <a href="{{ route('cliente.pedidos.index') }}" 
                   class="inline-flex items-center rounded-full border border-[#E9D5FF] bg-white/80 px-5 py-2.5 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] group">
                    <svg class="mr-2 h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver a Mis Pedidos
                </a>
            </div>

            <!-- Información del Pedido -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Información General -->
                <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur lg:col-span-2">
                    <div class="relative p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                            <h3 class="text-lg font-bold text-[#1F2937]">Información del Pedido</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">ID Pedido</p>
                                <p class="text-base font-semibold text-[#1F2937]">#{{ $order->id }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Fecha</p>
                                <p class="text-base font-semibold text-[#1F2937]">{{ $order->created_at->format('d/m/Y \a \l\a\s H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Estado</p>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'processing' => 'bg-blue-100 text-blue-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700'
                                    ];
                                    $statusLabels = [
                                        'pending' => '⏳ Pendiente',
                                        'processing' => '🔄 En proceso',
                                        'completed' => '✅ Completado',
                                        'cancelled' => '❌ Cancelado'
                                    ];
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Método de Pago</p>
                                <p class="text-base font-semibold text-[#1F2937]">{{ $order->payment_method ?? 'No especificado' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Estado Pago</p>
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-700">
                                    {{ ucfirst($order->payment_status ?? 'pendiente') }}
                                </span>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Dirección de Envío</p>
                                <p class="text-base text-[#1F2937]">{{ $order->shipping_address ?? 'No especificada' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Negocio -->
                <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                    <div class="relative p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#EC4899] to-[#F472B6]"></div>
                            <h3 class="text-lg font-bold text-[#1F2937]">Negocio</h3>
                        </div>
                        
                        <div>
                            <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Vendedor</p>
                            <p class="text-base font-semibold text-[#1F2937]">{{ $order->business->name ?? 'N/A' }}</p>
                        </div>
                        @if($order->notes)
                            <div class="mt-4">
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Notas</p>
                                <p class="text-sm text-[#6B7280]">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Productos del Pedido -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="relative p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Productos del Pedido</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-[#F3E8FF]">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-[#374151]">Producto</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-[#374151]">Cantidad</th>
                                    <th class="px-4 py-3 text-right text-sm font-semibold text-[#374151]">Precio Unitario</th>
                                    <th class="px-4 py-3 text-right text-sm font-semibold text-[#374151]">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#F3E8FF]">
                                @foreach($order->details as $detail)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            @if($detail->product && $detail->product->image)
                                                <img src="{{ asset('storage/' . $detail->product->image) }}" class="h-10 w-10 rounded-lg object-cover">
                                            @else
                                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3]">
                                                    <svg class="h-5 w-5 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <p class="font-medium text-[#1F2937]">{{ $detail->product->name ?? 'Producto eliminado' }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center text-[#6B7280]">{{ $detail->quantity }}</td>
                                    <td class="px-4 py-3 text-right font-medium text-[#1F2937]">${{ number_format($detail->price, 0) }}</td>
                                    <td class="px-4 py-3 text-right font-semibold text-[#7C3AED]">${{ number_format($detail->subtotal, 0) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-t border-[#F3E8FF] bg-[#F5F3FF]/30">
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-right font-bold text-[#1F2937]">Total:</td>
                                    <td class="px-4 py-3 text-right text-xl font-extrabold text-[#7C3AED]">${{ number_format($order->total, 0) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Botón de cancelación si está pendiente -->
                    @if($order->status === 'pending')
                        <div class="mt-6 pt-4 border-t border-[#F3E8FF] flex justify-end">
                            <form action="{{ route('cliente.pedidos.cancel', $order) }}" method="POST" 
                                  onsubmit="return confirm('¿Estás segura de cancelar este pedido? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="inline-flex items-center rounded-full border border-red-300 bg-red-50/80 px-6 py-2.5 text-sm font-medium text-red-600 transition-all duration-300 hover:bg-red-100">
                                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancelar Pedido
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-cliente-layout>