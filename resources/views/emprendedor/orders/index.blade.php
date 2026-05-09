<x-emprendedor-layout>
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
        
        <!-- Elementos decorativos -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <!-- Tarjetas de Estadísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $orders->total() }}</div>
                    <div class="text-sm font-semibold text-[#7C3AED]">Total Pedidos</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-2xl font-extrabold text-[#1F2937] mb-1 truncate">${{ number_format($orders->sum('total'), 0) }}</div>
                    <div class="text-sm font-semibold text-[#EC4899]">Ventas Totales</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $orders->where('status', 'pending')->count() }}</div>
                    <div class="text-sm font-semibold text-[#F59E0B]">Pendientes</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $orders->where('status', 'completed')->count() }}</div>
                    <div class="text-sm font-semibold text-[#A855F7]">Completados</div>
                </div>
            </div>

            <!-- Filtros -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 p-6 backdrop-blur mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
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
                                   placeholder="Buscar por ID, cliente o email..."
                                   class="w-full rounded-full border border-[#F3E8FF] bg-white/80 py-3 pl-10 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40">
                        </div>
                    </div>

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
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pendiente</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>🔄 En proceso</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Completado</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>❌ Cancelado</option>
                        </select>

                        <button id="filterBtn" class="rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899]">
                            Filtrar
                        </button>
                        
                        <a href="{{ route('emprendedor.orders.index') }}" class="rounded-full border border-[#E9D5FF] bg-white/80 px-6 py-3 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED]">
                            Limpiar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tabla de Pedidos -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-[#F3E8FF] bg-[#F5F3FF]/30">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">ID Pedido</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Cliente</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Negocio</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Total</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Estado</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Fecha</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-[#374151]">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F3E8FF]">
                            @forelse($orders as $order)
                            <tr class="hover:bg-[#FAF5FF]/50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-[#7C3AED]">#{{ $order->id }}</td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-medium text-[#1F2937]">{{ $order->user->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-[#6B7280]">{{ $order->user->email ?? 'N/A' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#6B7280]">{{ $order->business->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-[#1F2937]">${{ number_format($order->total, 0) }}</span>
                                    <span class="text-xs text-[#9CA3AF]">COP</span>
                                </td>
                                <td class="px-6 py-4">
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
                                </td>
                                <td class="px-6 py-4 text-sm text-[#6B7280]">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('emprendedor.orders.show', $order->id) }}" 
                                           class="rounded-lg p-2 text-[#7C3AED] hover:bg-[#F3E8FF] transition-colors" 
                                           title="Ver detalles">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-[#6B7280]">
                                    <svg class="mx-auto h-12 w-12 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <p class="mt-4 text-lg font-medium">No hay pedidos registrados</p>
                                    <p class="text-sm">Los pedidos que realicen los clientes aparecerán aquí.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($orders->hasPages())
                <div class="border-t border-[#F3E8FF] px-6 py-4">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('filterBtn')?.addEventListener('click', function() {
            const search = document.getElementById('searchInput')?.value || '';
            const businessId = document.getElementById('businessFilter')?.value || '';
            const status = document.getElementById('statusFilter')?.value || '';
            
            let url = new URL(window.location.href);
            url.searchParams.set('search', search);
            url.searchParams.set('business_id', businessId);
            url.searchParams.set('status', status);
            
            window.location.href = url.toString();
        });
        
        document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('filterBtn')?.click();
            }
        });
    </script>
</x-emprendedor-layout>