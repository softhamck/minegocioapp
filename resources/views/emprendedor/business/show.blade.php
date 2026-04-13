<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Detalle del Negocio
                </h2>
                <p class="text-sm text-[#6B7280]">
                    Información completa de tu establecimiento
                </p>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <!-- Decorative blur -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('emprendedor.business.index') }}" 
                   class="inline-flex items-center rounded-full border border-[#E9D5FF] bg-white/80 px-5 py-2.5 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] group">
                    <svg class="mr-2 h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a Mis Negocios
                </a>
            </div>

            <!-- Business Header Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur mb-6">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative p-6 sm:p-8">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-md">
                                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1F2937]">{{ $business->name }}</h1>
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($business->is_active)
                                            <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">
                                                <span class="mr-1 h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                                Activo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-700">
                                                <span class="mr-1 h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                                Inactivo
                                            </span>
                                        @endif
                                        <span class="text-xs text-[#6B7280]">Creado: {{ $business->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <div class="flex items-start gap-2">
                                    <svg class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                    <p class="text-[#6B7280] leading-relaxed">
                                        {{ $business->description ?? 'Sin descripción disponible.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 flex-shrink-0">
                            <a href="{{ route('emprendedor.business.edit', $business) }}" 
                               class="inline-flex items-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-5 py-2.5 text-sm font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)]">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>
                            <a href="{{ route('emprendedor.business.products.index', $business) }}" 
                               class="inline-flex items-center rounded-full border border-[#E9D5FF] bg-white/80 px-5 py-2.5 text-sm font-semibold text-[#7C3AED] transition-all duration-300 hover:bg-[#FAF5FF]">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                Ver Productos
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur mb-6">
                <div class="relative p-6 sm:p-8">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Información de Contacto</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Teléfono -->
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-[#7C3AED]/20 to-[#F472B6]/20">
                                <svg class="h-5 w-5 text-[#7C3AED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Teléfono</p>
                                <p class="text-base font-semibold text-[#1F2937]">{{ $business->telephone ?? 'No registrado' }}</p>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-[#7C3AED]/20 to-[#F472B6]/20">
                                <svg class="h-5 w-5 text-[#7C3AED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-[#6B7280] uppercase tracking-wide">Dirección</p>
                                <p class="text-base font-semibold text-[#1F2937]">{{ $business->address ?? 'No registrada' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $productsCount ?? 0 }}</div>
                    <div class="text-sm font-semibold text-[#7C3AED]">Productos</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">{{ $ordersCount ?? 0 }}</div>
                    <div class="text-sm font-semibold text-[#EC4899]">Pedidos</div>
                </div>
                <div class="group rounded-[1.5rem] border border-white/70 bg-white/80 p-5 shadow-[0_16px_40px_rgba(124,58,237,0.08)] backdrop-blur transition duration-300 hover:-translate-y-1 text-center">
                    <div class="text-3xl font-extrabold text-[#1F2937] mb-1">${{ number_format($totalSales ?? 0, 0) }}</div>
                    <div class="text-sm font-semibold text-[#A855F7]">Ventas Totales</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="relative p-6 sm:p-8">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Acciones Rápidas</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('emprendedor.business.products.create', $business) }}" 
                           class="flex items-center rounded-xl bg-gradient-to-r from-[#7C3AED]/10 to-[#F472B6]/10 border border-[#C4B5FD]/30 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-md group">
                            <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-[#7C3AED] to-[#A78BFA] shadow-md transition-transform duration-300 group-hover:scale-110">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-[#1F2937] group-hover:text-[#7C3AED] transition-colors">Agregar Producto</p>
                                <p class="text-xs text-[#6B7280]">Añade un nuevo producto al catálogo</p>
                            </div>
                        </a>

                        <a href="{{ route('emprendedor.business.edit', $business) }}" 
                           class="flex items-center rounded-xl bg-gradient-to-r from-[#EC4899]/10 to-[#F472B6]/10 border border-[#FBCFE8]/30 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-md group">
                            <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-[#EC4899] to-[#F472B6] shadow-md transition-transform duration-300 group-hover:scale-110">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-[#1F2937] group-hover:text-[#EC4899] transition-colors">Editar Negocio</p>
                                <p class="text-xs text-[#6B7280]">Modifica la información del negocio</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-emprendedor-layout>