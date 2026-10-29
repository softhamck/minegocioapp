{{-- Lista de pedidos en tarjetas para celular. Parámetros: $orders, $showRoute (nombre de la ruta de detalle) --}}
@php
    $mStatusColors = [
        'pending' => 'bg-yellow-100 text-yellow-700',
        'processing' => 'bg-blue-100 text-blue-700',
        'completed' => 'bg-green-100 text-green-700',
        'cancelled' => 'bg-red-100 text-red-700',
    ];
    $mStatusLabels = [
        'pending' => '⏳ Pendiente',
        'processing' => '🔄 En proceso',
        'completed' => '✅ Completado',
        'cancelled' => '❌ Cancelado',
    ];
@endphp
<div class="relative divide-y divide-[#F3E8FF] lg:hidden">
    @forelse($orders as $order)
        <a href="{{ route($showRoute, $order->id) }}" class="block p-4 transition-colors hover:bg-[#FAF5FF]/60">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-[#7C3AED]">Pedido #{{ $order->id }}</p>
                    <p class="truncate font-medium text-[#1F2937]">{{ $order->user->name ?? 'N/A' }}</p>
                    <p class="truncate text-xs text-[#6B7280]">{{ $order->business->name ?? 'N/A' }}</p>
                </div>
                <div class="shrink-0 text-right">
                    <p class="font-bold text-[#1F2937]">{{ \App\Support\Money::cop($order->total) }}</p>
                    <p class="text-xs text-[#9CA3AF]">{{ $order->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="mt-3 flex items-center justify-between">
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $mStatusColors[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                    {{ $mStatusLabels[$order->status] ?? $order->status }}
                </span>
                <span class="text-xs font-semibold text-[#7C3AED]">Ver detalle →</span>
            </div>
        </a>
    @empty
        <div class="px-6 py-12 text-center text-[#6B7280]">
            <p class="text-lg font-medium">No hay pedidos registrados</p>
            <p class="text-sm">Los pedidos que realicen los clientes aparecerán aquí.</p>
        </div>
    @endforelse
</div>
