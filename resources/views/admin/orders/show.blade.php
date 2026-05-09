<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Pedido #{{ $order->id }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <div class="relative z-10 max-w-5xl mx-auto">
            <!-- Botones de navegación -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <a href="{{ route('admin.orders.index') }}" 
                   class="inline-flex items-center rounded-full border border-[#E9D5FF] bg-white/80 px-5 py-2.5 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] group w-fit">
                    <svg class="mr-2 h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver a Pedidos
                </a>
                
                <form action="{{ route('admin.orders.destroy', $order) }}" 
                      method="POST" 
                      class="inline-block"
                      onsubmit="return confirm('¿Estás segura de eliminar este pedido?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center rounded-full bg-red-500/10 px-5 py-2.5 text-sm font-medium text-red-600 transition-all duration-300 hover:bg-red-500/20 hover:text-red-700">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Eliminar Pedido
                    </button>
                </form>
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
                                <p class="text-base font-semibold text-[#1F2937]">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Estado</p>
                                <div class="mt-1">
                                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" 
                                                class="rounded-full border border-[#F3E8FF] bg-white/80 px-3 py-1.5 text-sm font-medium text-[#1F2937] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Pendiente</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔄 En proceso</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Completado</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelado</option>
                                        </select>
                                        <button type="submit" class="rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-4 py-1.5 text-xs font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                                            Actualizar
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Método de Pago</p>
                                <p class="text-base font-semibold text-[#1F2937]">{{ $order->payment_method ?? 'No especificado' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Estado Pago</p>
                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-700">
                                    {{ ucfirst($order->payment_status ?? 'pending') }}
                                </span>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Dirección de Envío</p>
                                <p class="text-base text-[#1F2937]">{{ $order->shipping_address ?? 'No especificada' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cliente y Negocio -->
                <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                    <div class="relative p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#EC4899] to-[#F472B6]"></div>
                            <h3 class="text-lg font-bold text-[#1F2937]">Cliente y Negocio</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Cliente</p>
                                <p class="text-base font-semibold text-[#1F2937]">{{ $order->user->name ?? 'N/A' }}</p>
                                <p class="text-sm text-[#6B7280]">{{ $order->user->email ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Negocio</p>
                                <p class="text-base font-semibold text-[#1F2937]">{{ $order->business->name ?? 'N/A' }}</p>
                            </div>
                            @if($order->notes)
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Notas</p>
                                <p class="text-sm text-[#6B7280]">{{ $order->notes }}</p>
                            </div>
                            @endif
                        </div>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>