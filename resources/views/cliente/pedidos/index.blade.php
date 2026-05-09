<x-cliente-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Mis Pedidos
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <div class="relative z-10 max-w-7xl mx-auto">
            <!-- Filtro por estado -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 p-4 backdrop-blur mb-6">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('cliente.pedidos.index') }}" 
                       class="rounded-full px-4 py-2 text-sm font-medium transition-all duration-300 {{ !request('status') ? 'bg-gradient-to-r from-[#7C3AED] to-[#F472B6] text-white shadow-md' : 'bg-white/80 text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]' }}">
                        Todos
                    </a>
                    <a href="{{ route('cliente.pedidos.index', ['status' => 'pending']) }}" 
                       class="rounded-full px-4 py-2 text-sm font-medium transition-all duration-300 {{ request('status') == 'pending' ? 'bg-gradient-to-r from-[#7C3AED] to-[#F472B6] text-white shadow-md' : 'bg-white/80 text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]' }}">
                        ⏳ Pendientes
                    </a>
                    <a href="{{ route('cliente.pedidos.index', ['status' => 'processing']) }}" 
                       class="rounded-full px-4 py-2 text-sm font-medium transition-all duration-300 {{ request('status') == 'processing' ? 'bg-gradient-to-r from-[#7C3AED] to-[#F472B6] text-white shadow-md' : 'bg-white/80 text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]' }}">
                        🔄 En proceso
                    </a>
                    <a href="{{ route('cliente.pedidos.index', ['status' => 'completed']) }}" 
                       class="rounded-full px-4 py-2 text-sm font-medium transition-all duration-300 {{ request('status') == 'completed' ? 'bg-gradient-to-r from-[#7C3AED] to-[#F472B6] text-white shadow-md' : 'bg-white/80 text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]' }}">
                        ✅ Completados
                    </a>
                    <a href="{{ route('cliente.pedidos.index', ['status' => 'cancelled']) }}" 
                       class="rounded-full px-4 py-2 text-sm font-medium transition-all duration-300 {{ request('status') == 'cancelled' ? 'bg-gradient-to-r from-[#7C3AED] to-[#F472B6] text-white shadow-md' : 'bg-white/80 text-[#6B7280] hover:bg-[#FAF5FF] hover:text-[#7C3AED]' }}">
                        ❌ Cancelados
                    </a>
                </div>
            </div>

            <!-- Lista de Pedidos -->
            @if($orders->isEmpty())
                <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 p-12 text-center backdrop-blur">
                    <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-[#7C3AED]/20 to-[#F472B6]/20">
                        <svg class="h-12 w-12 text-[#7C3AED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1F2937] mb-3">No tienes pedidos</h3>
                    <p class="text-[#6B7280] mb-6">¡Realiza tu primera compra y aparece aquí!</p>
                    <a href="{{ route('cliente.productos.index') }}" 
                       class="inline-flex items-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3 font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Comenzar a Comprar
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur transition-all duration-300 hover:shadow-[0_20px_40px_rgba(124,58,237,0.12)]">
                            <div class="relative p-6">
                                <!-- Cabecera del pedido -->
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4 pb-4 border-b border-[#F3E8FF]">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-medium text-[#6B7280]">Pedido #</span>
                                            <span class="text-lg font-bold text-[#7C3AED]">{{ $order->id }}</span>
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
                                        <p class="text-xs text-[#6B7280] mt-1">{{ $order->created_at->format('d/m/Y \a \l\a\s H:i') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-[#6B7280]">Total</p>
                                        <p class="text-2xl font-extrabold text-[#7C3AED]">${{ number_format($order->total, 0) }}</p>
                                    </div>
                                </div>

                                <!-- Productos del pedido (resumen) -->
                                <div class="mb-4">
                                    <p class="text-sm font-medium text-[#6B7280] mb-2">Productos:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($order->details->take(3) as $detail)
                                            <span class="inline-flex items-center rounded-full bg-[#F3E8FF] px-3 py-1 text-xs font-medium text-[#7C3AED]">
                                                {{ $detail->quantity }}x {{ $detail->product->name ?? 'Producto' }}
                                            </span>
                                        @endforeach
                                        @if($order->details->count() > 3)
                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                                +{{ $order->details->count() - 3 }} más
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Botones de acción -->
                                <div class="flex flex-col sm:flex-row gap-3 pt-2 border-t border-[#F3E8FF]">
                                    <a href="{{ route('cliente.pedidos.show', $order) }}" 
                                       class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-4 py-2 text-sm font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Ver Detalle
                                    </a>
                                    
                                    @if($order->status === 'pending')
                                        <form action="{{ route('cliente.pedidos.cancel', $order) }}" method="POST" 
                                              onsubmit="return confirm('¿Estás segura de cancelar este pedido?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="inline-flex items-center justify-center rounded-full border border-red-300 bg-red-50/80 px-4 py-2 text-sm font-medium text-red-600 transition-all duration-300 hover:bg-red-100">
                                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Cancelar Pedido
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-8">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-cliente-layout>