<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">

            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">Mis Negocios</h2>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <!-- Decorative blur -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-6 mb-8 shadow-[0_20px_60px_rgba(124,58,237,0.10)] backdrop-blur-xl">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-[#1F2937]">Gestiona tus Negocios 🏪</h1>
                        </div>
                        <p class="text-[#6B7280] text-lg">
                            Crea y administra todos tus establecimientos en un solo lugar
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('emprendedor.business.create') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] hover:from-[#6D28D9] hover:to-[#EC4899] text-white font-semibold transition-all duration-300 hover:shadow-[0_16px_40px_rgba(124,58,237,0.28)] hover:-translate-y-0.5 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Crear Nuevo Negocio
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)] text-center">
                    <div class="text-4xl font-extrabold text-[#1F2937] mb-2">{{ $businesses->count() }}</div>
                    <div class="text-sm font-semibold text-[#7C3AED]">Negocios Activos</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)] text-center">
                    <div class="text-4xl font-extrabold text-[#1F2937] mb-2">{{ $totalProducts ?? '0' }}</div>
                    <div class="text-sm font-semibold text-[#EC4899]">Productos Totales</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-6 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_50px_rgba(124,58,237,0.12)] text-center">
                    <div class="text-4xl font-extrabold text-[#1F2937] mb-2">{{ $totalOrders ?? '0' }}</div>
                    <div class="text-sm font-semibold text-[#A855F7]">Pedidos Activos</div>
                </div>
            </div>

            <!-- Businesses Grid -->
            @if($businesses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($businesses as $business)
                        <div class="group rounded-2xl border border-white/60 bg-white/70 p-6 backdrop-blur transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(124,58,237,0.12)]">
                            <!-- Business Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-md transition-transform duration-300 group-hover:scale-110">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-[#1F2937] text-lg group-hover:text-[#7C3AED] transition-colors">
                                            {{ $business->name }}
                                        </h3>
                                        <p class="text-[#6B7280] text-sm">{{ $business->category ?? 'Sin categoría' }}</p>
                                    </div>
                                </div>
                                <div class="relative dropdown-content">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="p-1 rounded-lg text-[#9CA3AF] hover:text-[#7C3AED] hover:bg-[#F3E8FF] transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <div class="rounded-xl border border-[#F3E8FF] bg-white p-2 shadow-lg">
                                                <a href="{{ route('emprendedor.business.edit', $business) }}" class="flex items-center rounded-lg px-3 py-2 text-sm text-[#374151] hover:bg-[#F5F3FF] hover:text-[#7C3AED] transition-colors">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Editar
                                                </a>
                                                <form method="POST" action="{{ route('emprendedor.business.destroy', $business) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este negocio?')" class="flex w-full items-center rounded-lg px-3 py-2 text-sm text-[#E11D48] hover:bg-[#FFF1F2] hover:text-[#BE123C] transition-colors">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>

                            <!-- Business Description -->
                            <p class="text-[#6B7280] text-sm mb-4 line-clamp-2">
                                {{ $business->description ?? 'Sin descripción disponible.' }}
                            </p>

                            <!-- Business Stats -->
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="text-center p-2 rounded-lg bg-gradient-to-r from-[#7C3AED]/10 to-[#A78BFA]/10">
                                    <div class="text-[#1F2937] font-bold text-sm">{{ $business->products_count ?? '0' }}</div>
                                    <div class="text-[#6B7280] text-xs">Productos</div>
                                </div>
                                <div class="text-center p-2 rounded-lg bg-gradient-to-r from-[#EC4899]/10 to-[#F472B6]/10">
                                    <div class="text-[#1F2937] font-bold text-sm">{{ $business->orders_count ?? '0' }}</div>
                                    <div class="text-[#6B7280] text-xs">Pedidos</div>
                                </div>
                                <div class="text-center p-2 rounded-lg bg-gradient-to-r from-[#A855F7]/10 to-[#C4B5FD]/10">
                                    <div class="text-[#1F2937] font-bold text-sm">{{ $business->is_active ? 'Activo' : 'Inactivo' }}</div>
                                    <div class="text-[#6B7280] text-xs">Estado</div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('emprendedor.business.show', $business) }}" 
                                   class="flex-1 text-center py-2 px-3 rounded-full text-sm font-medium transition-all duration-300 bg-gradient-to-r from-[#7C3AED]/10 to-[#A78BFA]/10 text-[#7C3AED] hover:from-[#7C3AED] hover:to-[#A78BFA] hover:text-white border border-[#C4B5FD]/30 hover:border-transparent">
                                    Ver Detalles
                                </a>
                                <a href="{{ route('emprendedor.business.products.index', $business->id) }}" 
                                   class="flex-1 text-center py-2 px-3 rounded-full text-sm font-medium transition-all duration-300 bg-gradient-to-r from-[#EC4899]/10 to-[#F472B6]/10 text-[#EC4899] hover:from-[#EC4899] hover:to-[#F472B6] hover:text-white border border-[#FBCFE8]/30 hover:border-transparent">
                                    Productos
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="relative overflow-hidden rounded-[2rem] border border-white/70 bg-white/75 p-12 text-center shadow-[0_20px_60px_rgba(124,58,237,0.10)] backdrop-blur-xl">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                    <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                    
                    <div class="relative">
                        <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-[#7C3AED]/20 to-[#F472B6]/20">
                            <svg class="h-12 w-12 text-[#7C3AED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-[#1F2937] mb-3">No tienes negocios aún</h3>
                        <p class="text-[#6B7280] mb-6 max-w-md mx-auto">
                            Comienza creando tu primer negocio para gestionar productos, recibir pedidos y conectar con clientes.
                        </p>
                        <a href="{{ route('emprendedor.business.create') }}" 
                           class="inline-flex items-center px-8 py-4 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] hover:from-[#6D28D9] hover:to-[#EC4899] text-white font-semibold transition-all duration-300 hover:shadow-[0_16px_40px_rgba(124,58,237,0.28)] hover:-translate-y-0.5 shadow-lg text-lg">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Crear mi Primer Negocio
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-emprendedor-layout>