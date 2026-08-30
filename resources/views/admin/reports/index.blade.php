<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Reportes del Sistema
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

    <div class="py-6 sm:py-10 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Header card -->
            <div class="glass-soft rounded-2xl p-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-[#1F2937] mb-2">Visión general del negocio</h1>
                <p class="text-[#6B7280]">Resumen de ventas, pedidos y desempeño de la plataforma</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-soft rounded-xl p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-md mb-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 2v8m0 0v2m0-2c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-2xl font-extrabold text-[#1F2937]">${{ number_format($totalRevenue, 2) }}</div>
                    <p class="text-sm text-[#6B7280] mt-1">Ingresos totales (pedidos completados)</p>
                </div>

                <div class="glass-soft rounded-xl p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#EC4899] via-[#F472B6] to-[#FBCFE8] shadow-md mb-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <div class="text-2xl font-extrabold text-[#1F2937]">{{ $totalOrders }}</div>
                    <p class="text-sm text-[#6B7280] mt-1">Pedidos totales</p>
                </div>

                <div class="glass-soft rounded-xl p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#A855F7] via-[#C4B5FD] to-[#E9D5FF] shadow-md mb-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                        </svg>
                    </div>
                    <div class="text-2xl font-extrabold text-[#1F2937]">{{ $totalBusinesses }}</div>
                    <p class="text-sm text-[#6B7280] mt-1">Negocios registrados ({{ $activeBusinesses }} activos)</p>
                </div>

                <div class="glass-soft rounded-xl p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] to-[#EC4899] shadow-md mb-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4 4 4 0 004 4z"/>
                        </svg>
                    </div>
                    <div class="text-2xl font-extrabold text-[#1F2937]">
                        @foreach ($usersByRole as $group)
                            <span class="block text-base font-semibold">{{ $group->total }} {{ $group->rol->name ?? 'usuarios' }}</span>
                        @endforeach
                    </div>
                    <p class="text-sm text-[#6B7280] mt-1">Usuarios por rol</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Monthly sales -->
                <div class="glass-soft rounded-2xl p-6 lg:col-span-2">
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
                <div class="glass-soft rounded-2xl p-6">
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
                            <p class="text-sm text-[#6B7280]">Todavía no hay pedidos registrados.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Top products -->
            <div class="glass-soft rounded-2xl p-6">
                <div class="flex items-center gap-2 mb-6">
                    <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                    <h3 class="text-lg font-bold text-[#1F2937]">Productos más vendidos</h3>
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
</x-app-layout>
