<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_12px_30px_rgba(124,58,237,0.22)]">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Editar Producto
                </h2>
                <p class="text-sm text-[#6B7280]">
                    Modifica la información del producto
                </p>
            </div>
        </div>
    </x-slot>

    <div class="relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.16),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] min-h-screen">
        
        <!-- Elementos decorativos -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/30 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/15 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/30 blur-3xl"></div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('admin.products.index') }}" 
                   class="inline-flex items-center rounded-full border border-[#E9D5FF] bg-white/80 px-5 py-2.5 text-sm font-medium text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] group">
                    <svg class="mr-2 h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver a Productos
                </a>
            </div>

            <!-- Form Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative p-6 sm:p-8">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Información del Producto</h3>
                    </div>

                    <form action="{{ route('admin.products.update', $product->id) }}"
                          method="POST" enctype="multipart/form-data"
                          class="space-y-6">

                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-[#374151] mb-2">
                                Nombre del Producto <span class="text-[#E11D48]">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       value="{{ old('name', $product->name) }}"
                                       placeholder="Ej: Camiseta Premium, Café Especial"
                                       class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 pl-10 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                       required>
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-[#E11D48]">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-[#374151] mb-2">
                                Descripción
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute left-3 top-3">
                                    <svg class="h-5 w-5 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <textarea 
                                    name="description" 
                                    rows="4"
                                    placeholder="Describe las características, beneficios y detalles del producto..."
                                    class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 pl-10 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200 resize-none"
                                >{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>

                        <!-- Precio y Stock -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-[#374151] mb-2">
                                    Precio <span class="text-[#E11D48]">*</span>
                                </label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[#9CA3AF]">$</span>
                                    <input type="number" 
                                           name="price" 
                                           value="{{ old('price', $product->price) }}"
                                           placeholder="0.00"
                                           step="0.01"
                                           min="0"
                                           class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 pl-8 pr-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                           required>
                                </div>
                                @error('price')
                                    <p class="mt-1 text-sm text-[#E11D48]">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="quantity" class="block text-sm font-medium text-[#374151] mb-2">
                                    Cantidad en Stock <span class="text-[#E11D48]">*</span>
                                </label>
                                <input type="number" 
                                       name="quantity" 
                                       value="{{ old('quantity', $product->quantity) }}"
                                       placeholder="0"
                                       min="0"
                                       class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 px-4 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                       required>
                                @error('quantity')
                                    <p class="mt-1 text-sm text-[#E11D48]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">
                                Imagen del Producto
                            </label>
                            <div class="rounded-xl border-2 border-dashed border-[#E9D5FF] bg-white/60 p-6 text-center transition-all duration-200 hover:border-[#C4B5FD]">
                                <input type="file" 
                                       id="image"
                                       name="image" 
                                       class="hidden"
                                       accept="image/*">
                                <label for="image" class="cursor-pointer">
                                    <div id="imagePreview" class="flex flex-col items-center">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                 class="mx-auto mb-3 h-24 w-24 rounded-lg object-cover shadow-md">
                                            <p class="text-sm font-medium text-[#7C3AED]">Imagen actual</p>
                                            <p class="text-xs text-[#6B7280] mt-1">Haz clic para cambiar</p>
                                        @else
                                            <svg class="mx-auto h-12 w-12 text-[#9CA3AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="mt-2 text-sm text-[#6B7280]">Haz clic para subir una imagen</p>
                                            <p class="text-xs text-[#9CA3AF]">PNG, JPG, JPEG hasta 5MB</p>
                                        @endif
                                    </div>
                                </label>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-[#E11D48]">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-[#6B7280]">Dejar en blanco para mantener la imagen actual</p>
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="active" class="block text-sm font-medium text-[#374151] mb-2">
                                Estado del Producto
                            </label>
                            <select name="active" 
                                    class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 py-3 px-4 text-[#1F2937] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
                                <option value="1" {{ $product->active == 1 ? 'selected' : '' }}>🟢 Activo - Visible para clientes</option>
                                <option value="0" {{ $product->active == 0 ? 'selected' : '' }}>🔴 Inactivo - No visible para clientes</option>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#F3E8FF]">
                            <button type="submit"
                                    class="flex-1 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-8 py-3 font-semibold text-white transition-all duration-300 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)] flex items-center justify-center group">
                                <svg class="mr-2 h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Actualizar Producto
                            </button>
                            
                            <a href="{{ route('admin.products.index') }}"
                               class="flex-1 rounded-full border border-[#E9D5FF] bg-white/80 px-8 py-3 text-center font-semibold text-[#374151] transition-all duration-300 hover:bg-[#FAF5FF] hover:text-[#7C3AED] flex items-center justify-center group">
                                <svg class="mr-2 h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            
            if (fileInput && imagePreview) {
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.innerHTML = `
                                <img src="${e.target.result}" class="mx-auto mb-3 h-24 w-24 rounded-lg object-cover shadow-md">
                                <p class="text-sm font-medium text-[#7C3AED]">Nueva imagen seleccionada</p>
                                <p class="text-xs text-[#6B7280] mt-1">${file.name}</p>
                            `;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
</x-app-layout>