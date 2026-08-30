<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Reportes
                </h2>
            </div>
        </div>
    </x-slot>

    @php
        $statusLabels = [
            'pending' => '⏳ Pendiente',
            'processing' => '🔄 En proceso',
            'completed' => '✅ Completado',
            'cancelled' => '❌ Cancelado',
        ];
        $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-700',
            'processing' => 'bg-blue-100 text-blue-700',
            'completed' => 'bg-green-100 text-green-700',
            'cancelled' => 'bg-red-100 text-red-700',
        ];
    @endphp

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">

        <!-- Elementos decorativos -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto space-y-8">

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-2xl font-extrabold text-[#1F2937] mb-1">${{ number_format($totalRevenue, 2) }}</div>
                    <div class="text-sm font-semibold text-[#7C3AED]">Ingresos (pedidos completados)</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $totalOrders }}</div>
                    <div class="text-sm font-semibold text-[#EC4899]">Pedidos totales</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $ordersByStatus->get('completed', 0) }}</div>
                    <div class="text-sm font-semibold text-[#A855F7]">Pedidos completados</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Monthly sales -->
                <div class="rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur lg:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Ventas de los últimos 6 meses</h3>
                    </div>

                    <div class="flex items-end justify-between gap-3 h-48">
                        @foreach ($months as $month)
                            <div class="flex flex-1 flex-col items-center gap-2">
                                <div class="text-xs font-semibold text-[#7C3AED]">
                                    @if ($month['total'] > 0)
                                        ${{ number_format($month['total'], 0) }}
                                    @endif
                                </div>
                                <div class="w-full max-w-[42px] rounded-t-lg bg-gradient-to-t from-[#7C3AED] to-[#F472B6] transition-all duration-300"
                                     style="height: {{ max(6, round(($month['total'] / $maxMonthlyTotal) * 100)) }}%"></div>
                                <div class="text-xs text-[#6B7280]">{{ $month['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Orders by status -->
                <div class="rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Pedidos por estado</h3>
                    </div>

                    <div class="space-y-3">
                        @forelse ($ordersByStatus as $status => $count)
                            <div class="flex items-center justify-between rounded-xl px-4 py-3 {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-700' }}">
                                <span class="text-sm font-semibold">{{ $statusLabels[$status] ?? ucfirst($status) }}</span>
                                <span class="text-lg font-extrabold">{{ $count }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-[#6B7280]">Todavía no tienes pedidos registrados.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Top products -->
            <div class="rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur">
                <div class="flex items-center gap-2 mb-6">
                    <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                    <h3 class="text-lg font-bold text-[#1F2937]">Tus productos más vendidos</h3>
                </div>

                @if ($topProducts->isEmpty())
                    <p class="text-sm text-[#6B7280]">Aún no hay ventas suficientes para mostrar un ranking.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs font-semibold uppercase tracking-wide text-[#9CA3AF] border-b border-[#F3E8FF]">
                                    <th class="py-2 pr-4">Producto</th>
                                    <th class="py-2 pr-4">Unidades vendidas</th>
                                    <th class="py-2 pr-4">Ingresos generados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topProducts as $item)
                                    <tr class="border-b border-[#F3E8FF]/70 last:border-0">
                                        <td class="py-3 pr-4 text-sm font-medium text-[#1F2937]">{{ $item->product->name ?? 'Producto eliminado' }}</td>
                                        <td class="py-3 pr-4 text-sm text-[#6B7280]">{{ $item->total_quantity }}</td>
                                        <td class="py-3 pr-4 text-sm text-[#6B7280]">${{ number_format($item->total_revenue, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-emprendedor-layout>
