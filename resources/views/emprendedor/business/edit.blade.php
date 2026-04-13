<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Editar Negocio
                </h2>
                <p class="text-sm text-[#6B7280]">
                    Modifica la información de tu establecimiento
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
                <a href="{{ route('emprendedor.business.show', $business) }}" 
                   class="inline-flex items-center rounded-full border border-[#E9D5FF] bg-white/80 px-5 py-2.5 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] group">
                    <svg class="mr-2 h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver al Negocio
                </a>
            </div>

            <!-- Form Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative p-6 sm:p-8">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Información del Negocio</h3>
                    </div>

                    <form action="{{ route('emprendedor.business.update', $business) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nombre del Negocio -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-[#374151] mb-2">
                                Nombre del Negocio <span class="text-[#E11D48]">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="name"
                                    name="name" 
                                    value="{{ old('name', $business->name) }}"
                                    placeholder="Ej: Mi Tienda Online, Restaurante Familiar"
                                    class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 pl-10 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                    required
                                    autofocus>
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-[#E11D48]">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-[#374151] mb-2">
                                Descripción del Negocio <span class="text-[#E11D48]">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute left-3 top-3">
                                    <svg class="h-5 w-5 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                </div>
                                <textarea 
                                    id="description"
                                    name="description" 
                                    rows="4"
                                    placeholder="Describe tu negocio, los productos o servicios que ofreces, tu misión, etc."
                                    class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 pl-10 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200 resize-none"
                                    required
                                >{{ old('description', $business->description) }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-[#E11D48]">{{ $message }}</p>
                            @enderror
                            <div class="mt-1 flex justify-between">
                                <p class="text-xs text-[#6B7280]">Sé específico para atraer a tus clientes ideales</p>
                                <span id="charCount" class="text-xs text-[#6B7280]">{{ strlen($business->description ?? '') }}/500</span>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label for="telephone" class="block text-sm font-medium text-[#374151] mb-2">
                                Teléfono de Contacto <span class="text-[#E11D48]">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="tel" 
                                    id="telephone"
                                    name="telephone" 
                                    value="{{ old('telephone', $business->telephone) }}"
                                    placeholder="Ej: +57 300 123 4567"
                                    class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 pl-10 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                    required>
                            </div>
                            @error('telephone')
                                <p class="mt-1 text-sm text-[#E11D48]">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-[#6B7280]">Incluye código de país para clientes internacionales</p>
                        </div>

                        <!-- Dirección -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-[#374151] mb-2">
                                Dirección del Establecimiento
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="address"
                                    name="address" 
                                    value="{{ old('address', $business->address) }}"
                                    placeholder="Ej: Calle 123 #45-67, Ciudad, País"
                                    class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 pl-10 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
                            </div>
                            @error('address')
                                <p class="mt-1 text-sm text-[#E11D48]">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-[#6B7280]">Opcional - Para negocios con ubicación física</p>
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="is_active" class="block text-sm font-medium text-[#374151] mb-2">
                                Estado del Negocio
                            </label>
                            <select id="is_active"
                                    name="is_active" 
                                    class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 px-4 text-[#1F2937] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
                                <option value="1" {{ $business->is_active == 1 ? 'selected' : '' }}>🟢 Activo - Visible para clientes</option>
                                <option value="0" {{ $business->is_active == 0 ? 'selected' : '' }}>🔴 Inactivo - No visible para clientes</option>
                            </select>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#F3E8FF]">
                            <button type="submit"
                                    class="flex-1 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-8 py-3 font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)] flex items-center justify-center group">
                                <svg class="mr-2 h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Actualizar Negocio
                            </button>
                            
                            <a href="{{ route('emprendedor.business.show', $business) }}"
                               class="flex-1 rounded-full border border-[#E9D5FF] bg-white/80 px-8 py-3 text-center font-semibold text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] flex items-center justify-center group">
                                <svg class="mr-2 h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 p-6 mt-6 backdrop-blur">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="h-5 w-5 text-[#F472B6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h4 class="text-lg font-semibold text-[#1F2937]">Consejos para tu Negocio</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="flex items-start space-x-3">
                        <div class="mt-0.5 flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-[#7C3AED]/20 to-[#F472B6]/20">
                            <span class="text-xs font-bold text-[#7C3AED]">1</span>
                        </div>
                        <p class="text-[#6B7280]">Mantén la información actualizada para tus clientes</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="mt-0.5 flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-[#7C3AED]/20 to-[#F472B6]/20">
                            <span class="text-xs font-bold text-[#7C3AED]">2</span>
                        </div>
                        <p class="text-[#6B7280]">Un teléfono activo genera más confianza en los clientes</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="mt-0.5 flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-[#7C3AED]/20 to-[#F472B6]/20">
                            <span class="text-xs font-bold text-[#7C3AED]">3</span>
                        </div>
                        <p class="text-[#6B7280]">La dirección ayuda a clientes locales a encontrarte fácilmente</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="mt-0.5 flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-[#7C3AED]/20 to-[#F472B6]/20">
                            <span class="text-xs font-bold text-[#7C3AED]">4</span>
                        </div>
                        <p class="text-[#6B7280]">Un negocio activo siempre tendrá más visibilidad</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const descriptionTextarea = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            
            if (descriptionTextarea && charCount) {
                const updateCharCount = () => {
                    const length = descriptionTextarea.value.length;
                    charCount.textContent = `${length}/500`;
                    
                    if (length > 450) {
                        charCount.classList.add('text-[#EC4899]');
                        charCount.classList.remove('text-[#6B7280]');
                    } else {
                        charCount.classList.remove('text-[#EC4899]');
                        charCount.classList.add('text-[#6B7280]');
                    }
                };
                
                descriptionTextarea.addEventListener('input', updateCharCount);
                updateCharCount();
            }
        });
    </script>
</x-emprendedor-layout>