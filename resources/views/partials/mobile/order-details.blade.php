{{-- Productos de un pedido en formato lista para celular. Parámetro: $order --}}
<div class="divide-y divide-[#F3E8FF] md:hidden">
    @foreach($order->details as $detail)
        <div class="flex items-center gap-3 py-3">
            @if($detail->product && $detail->product->image)
                <img src="{{ asset('storage/' . $detail->product->image) }}" class="h-12 w-12 shrink-0 rounded-lg object-cover" alt="">
            @else
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3]">
                    <svg class="h-5 w-5 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            @endif
            <div class="min-w-0 flex-1">
                <p class="font-medium leading-tight text-[#1F2937]">{{ $detail->product->name ?? 'Producto eliminado' }}</p>
                <p class="text-sm text-[#6B7280]">{{ $detail->quantity }} × {{ \App\Support\Money::cop($detail->price) }}</p>
            </div>
            <p class="shrink-0 font-semibold text-[#7C3AED]">{{ \App\Support\Money::cop($detail->subtotal) }}</p>
        </div>
    @endforeach
    <div class="flex items-center justify-between pt-3">
        <span class="font-bold text-[#1F2937]">Total</span>
        <span class="text-xl font-extrabold text-[#7C3AED]">{{ \App\Support\Money::cop($order->total) }}</span>
    </div>
</div>
