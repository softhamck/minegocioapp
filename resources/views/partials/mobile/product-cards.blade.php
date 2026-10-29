{{-- Lista de productos en tarjetas para celular.
     Parámetros: $products, $editUrl (closure), $deleteUrl (closure), $showBusiness (bool, opcional) --}}
<div class="relative divide-y divide-[#F3E8FF] md:hidden">
    @forelse($products as $product)
        <div class="flex gap-3 p-4">
            <div class="shrink-0">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="h-16 w-16 rounded-xl bg-[#F3E8FF] object-cover" alt="">
                @else
                    <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3]">
                        <svg class="h-7 w-7 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="min-w-0 flex-1">
                <div class="flex items-start justify-between gap-2">
                    <p class="font-semibold leading-tight text-[#1F2937]">{{ $product->name }}</p>
                    @if($product->active == 1)
                        <span class="shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">Activo</span>
                    @else
                        <span class="shrink-0 rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-700">Inactivo</span>
                    @endif
                </div>
                @if(!empty($showBusiness))
                    <p class="truncate text-xs font-medium text-[#7C3AED]">{{ $product->business->name ?? 'N/A' }}</p>
                @endif
                <div class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm">
                    <span class="font-bold text-[#1F2937]">{{ \App\Support\Money::cop($product->price) }}</span>
                    <span class="text-[#6B7280]">Stock: {{ $product->quantity }}</span>
                    @if($product->quantity == 0)
                        <span class="rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-[#E11D48]">Sin stock</span>
                    @elseif($product->quantity <= 5)
                        <span class="rounded-full bg-orange-100 px-2 py-0.5 text-xs font-medium text-orange-600">Bajo stock</span>
                    @endif
                </div>
                <div class="mt-3 flex gap-2">
                    <a href="{{ $editUrl($product) }}"
                       class="flex-1 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-3 py-2 text-center text-sm font-semibold text-white">
                        Editar
                    </a>
                    <form action="{{ $deleteUrl($product) }}" method="POST"
                          onsubmit="return confirm('¿Estás segura de que quieres eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-full border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-[#E11D48]">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="px-6 py-12 text-center text-[#6B7280]">No hay productos registrados.</div>
    @endforelse
</div>
