<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Todos mis Productos
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <!-- Elementos decorativos -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <!-- Tarjetas de Estadísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $products->total() }}</div>
                    <div class="text-sm font-semibold text-[#7C3AED]">Total Productos</div>
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

            <!-- Filtros -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 p-6 backdrop-blur mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Búsqueda -->
                    <div class="flex-1">
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" 
                                   id="searchInput"
                                   value="{{ request('search') }}"
                                   placeholder="Buscar productos..."
                                   class="w-full rounded-full border border-[#F3E8FF] bg-white/80 py-3 pl-10 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="flex flex-wrap gap-3">
                        <select id="businessFilter" class="rounded-full border border-[#F3E8FF] bg-white/80 px-5 py-3 text-sm font-medium text-[#374151] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40">
                            <option value="">Todos los negocios</option>
                            @foreach($businesses as $business)
                                <option value="{{ $business->id }}" {{ request('business_id') == $business->id ? 'selected' : '' }}>
                                    {{ $business->name }}
                                </option>
                            @endforeach
                        </select>

                        <select id="statusFilter" class="rounded-full border border-[#F3E8FF] bg-white/80 px-5 py-3 text-sm font-medium text-[#374151] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40">
                            <option value="">Todos los estados</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>🟢 Activos</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>🔴 Inactivos</option>
                        </select>

                        <select id="sortFilter" class="rounded-full border border-[#F3E8FF] bg-white/80 px-5 py-3 text-sm font-medium text-[#374151] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>📅 Más recientes</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>💰 Precio: menor a mayor</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>💰 Precio: mayor a menor</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>📝 Nombre: A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>📝 Nombre: Z-A</option>
                        </select>

                        <button id="filterBtn" class="rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                            Filtrar
                        </button>
                        
                        <a href="{{ route('emprendedor.products.all') }}" class="rounded-full border border-[#E9D5FF] bg-white/80 px-6 py-3 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED]">
                            Limpiar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Grid de Productos -->
            @if($products->isEmpty())
                <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 p-12 text-center backdrop-blur">
                    <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-[#7C3AED]/20 to-[#F472B6]/20">
                        <svg class="h-12 w-12 text-[#7C3AED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1F2937] mb-3">No hay productos</h3>
                    <p class="text-[#6B7280] mb-6">Comienza agregando productos a tus negocios.</p>
                    <a href="{{ route('emprendedor.business.index') }}" 
                       class="inline-flex items-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3 font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Ir a Mis Negocios
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="group rounded-2xl border border-white/60 bg-white/70 p-5 backdrop-blur transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(124,58,237,0.12)]">
                            <!-- Imagen del Producto -->
                            <div class="relative mb-4 h-48 w-full overflow-hidden rounded-xl">
                                @if($product->image && Storage::disk('public')->exists($product->image))
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#F3E8FF] to-[#FCE7F3]">
                                        <svg class="h-12 w-12 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Badge del Negocio -->
                                <div class="absolute bottom-2 left-2">
                                    <span class="rounded-full bg-black/60 px-2 py-1 text-xs font-medium text-white backdrop-blur-sm">
                                        {{ $product->business->name }}
                                    </span>
                                </div>

                                <!-- Stock y Estado -->
                                @if($product->quantity == 0)
                                    <div class="absolute right-2 top-2">
                                        <span class="rounded-full bg-red-500/90 px-2 py-1 text-xs font-medium text-white backdrop-blur-sm">
                                            Sin stock
                                        </span>
                                    </div>
                                @elseif($product->quantity <= 5)
                                    <div class="absolute right-2 top-2">
                                        <span class="rounded-full bg-orange-500/90 px-2 py-1 text-xs font-medium text-white backdrop-blur-sm">
                                            Stock bajo
                                        </span>
                                    </div>
                                @endif

                                @if($product->active == 0)
                                    <div class="absolute left-2 top-2">
                                        <span class="rounded-full bg-gray-500/90 px-2 py-1 text-xs font-medium text-white backdrop-blur-sm">
                                            Inactivo
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Información del Producto -->
                            <h3 class="text-lg font-bold text-[#1F2937] line-clamp-1 group-hover:text-[#7C3AED] transition-colors">
                                {{ $product->name }}
                            </h3>
                            
                            @if($product->description)
                                <p class="mt-1 text-sm text-[#6B7280] line-clamp-2">
                                    {{ $product->description }}
                                </p>
                            @endif
                            
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-extrabold text-[#1F2937]">${{ number_format($product->price, 0) }}</span>
                                    <span class="ml-1 text-xs text-[#9CA3AF]">COP</span>
                                </div>
                                <div class="text-sm text-[#6B7280]">
                                    Stock: {{ $product->quantity }}
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('emprendedor.business.products.edit', [$product->business_id, $product->id]) }}" 
                                   class="flex-1 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] py-2 text-center text-sm font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                                    Editar
                                </a>
                                <a href="{{ route('emprendedor.business.products.index', $product->business_id) }}" 
                                   class="rounded-full border border-[#E9D5FF] bg-white/80 px-3 py-2 text-sm font-medium text-[#7C3AED] transition-all duration-300 hover:bg-[#FAF5FF]"
                                   title="Ver en el negocio">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-8">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Filtros dinámicos
        document.getElementById('filterBtn')?.addEventListener('click', function() {
            const search = document.getElementById('searchInput')?.value || '';
            const businessId = document.getElementById('businessFilter')?.value || '';
            const status = document.getElementById('statusFilter')?.value || '';
            const sort = document.getElementById('sortFilter')?.value || 'latest';
            
            let url = new URL(window.location.href);
            url.searchParams.set('search', search);
            url.searchParams.set('business_id', businessId);
            url.searchParams.set('status', status);
            url.searchParams.set('sort', sort);
            
            window.location.href = url.toString();
        });
        
        document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('filterBtn')?.click();
            }
        });
    </script>

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-emprendedor-layout>