<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-white">
                    Agregar Producto
                </h2>
                <p class="text-gray-400 text-sm">
                    {{ $business->name }} - Completa la información del nuevo producto
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('emprendedor.business.products.index', $business) }}" 
                   class="inline-flex items-center glass-card border border-gray-600 hover:border-gray-500 text-gray-300 hover:text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a Productos
                </a>
            </div>

            <!-- Form Card -->
            <div class="glass-card rounded-2xl p-6">
                <form action="{{ route('emprendedor.business.products.store', $business) }}"
                      method="POST" enctype="multipart/form-data"
                      class="space-y-8">

                    @csrf

                    <!-- Product Name -->
                    <div class="space-y-3">
                        <label for="name" class="block text-sm font-semibold text-white flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Nombre del Producto *
                        </label>
                        <input type="text" 
                               id="name"
                               name="name" 
                               value="{{ old('name') }}"
                               placeholder="Ej: Camiseta Premium, Café Especial, etc."
                               class="w-full bg-gray-900/50 border-2 border-gray-600 text-white placeholder-gray-500 rounded-xl px-4 py-4 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-200 text-lg font-medium"
                               required
                               autofocus>
                        @error('name')
                            <p class="text-red-400 text-sm flex items-center mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="space-y-3">
                        <label for="description" class="block text-sm font-semibold text-white flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            Descripción
                        </label>
                        <textarea 
                            id="description"
                            name="description" 
                            rows="4"
                            placeholder="Describe las características, beneficios y detalles del producto..."
                            class="w-full bg-gray-900/50 border-2 border-gray-600 text-white placeholder-gray-500 rounded-xl px-4 py-4 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-200 resize-none leading-relaxed"
                        >{{ old('description') }}</textarea>
                        <div class="flex justify-between items-center">
                            <p class="text-gray-400 text-sm">Incluye detalles que ayuden a vender tu producto</p>
                            <span id="charCount" class="text-gray-500 text-sm font-medium">0/1000</span>
                        </div>
                    </div>

                    <!-- Price and Quantity -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Price -->
                        <div class="space-y-3">
                            <label for="price" class="block text-sm font-semibold text-white flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                                Precio *
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">$</span>
                                <input type="number" 
                                       id="price"
                                       name="price" 
                                       value="{{ old('price') }}"
                                       placeholder="0.00"
                                       step="0.01"
                                       min="0"
                                       class="w-full bg-gray-900/50 border-2 border-gray-600 text-white placeholder-gray-500 rounded-xl pl-10 pr-4 py-4 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all duration-200"
                                       required>
                            </div>
                            @error('price')
                                <p class="text-red-400 text-sm flex items-center mt-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="space-y-3">
                            <label for="quantity" class="block text-sm font-semibold text-white flex items-center">
                                <svg class="w-4 h-4 mr-2 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                Cantidad en Stock *
                            </label>
                            <input type="number" 
                                   id="quantity"
                                   name="quantity" 
                                   value="{{ old('quantity') }}"
                                   placeholder="0"
                                   min="0"
                                   class="w-full bg-gray-900/50 border-2 border-gray-600 text-white placeholder-gray-500 rounded-xl px-4 py-4 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/20 transition-all duration-200"
                                   required>
                            @error('quantity')
                                <p class="text-red-400 text-sm flex items-center mt-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="space-y-3">
                        <label for="image" class="block text-sm font-semibold text-white flex items-center">
                            <svg class="w-4 h-4 mr-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Imagen del Producto
                        </label>
                        <div class="border-2 border-dashed border-gray-600 rounded-xl p-6 text-center hover:border-cyan-500 transition-all duration-200">
                            <input type="file" 
                                   id="image"
                                   name="image" 
                                   class="hidden"
                                   accept="image/*">
                            <label for="image" class="cursor-pointer">
                                <svg class="w-12 h-12 mx-auto text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-gray-400 mb-2">Haz clic para subir una imagen</p>
                                <p class="text-gray-500 text-sm">PNG, JPG, JPEG hasta 5MB</p>
                            </label>
                        </div>
                        @error('image')
                            <p class="text-red-400 text-sm flex items-center mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-3">
                        <label for="active" class="block text-sm font-semibold text-white flex items-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Estado del Producto
                        </label>
                        <select id="active"
                                name="active" 
                                class="w-full bg-gray-900/50 border-2 border-gray-600 text-white rounded-xl px-4 py-4 focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/20 transition-all duration-200">
                            <option value="1" selected>🟢 Activo - Visible para clientes</option>
                            <option value="0">🔴 Inactivo - No visible para clientes</option>
                        </select>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-700/50">
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-8 py-4 rounded-xl transition-all duration-300 hover-glow font-semibold text-lg flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Crear Producto
                        </button>
                        
                        <a href="{{ route('emprendedor.business.products.index', $business) }}"
                           class="flex-1 glass-card border-2 border-gray-600 hover:border-gray-500 text-gray-300 hover:text-white px-8 py-4 rounded-xl transition-all duration-300 font-semibold text-lg flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Character counter for description
            const descriptionTextarea = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            
            descriptionTextarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = `${length}/1000`;
                
                if (length > 900) {
                    charCount.classList.add('text-yellow-400');
                    charCount.classList.remove('text-gray-500');
                } else if (length > 800) {
                    charCount.classList.add('text-orange-400');
                    charCount.classList.remove('text-yellow-400', 'text-gray-500');
                } else {
                    charCount.classList.remove('text-yellow-400', 'text-orange-400');
                    charCount.classList.add('text-gray-500');
                }
            });
            
            // Trigger initial count
            descriptionTextarea.dispatchEvent(new Event('input'));

            // File upload preview
            const fileInput = document.getElementById('image');
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const label = fileInput.nextElementSibling;
                    label.innerHTML = `
                        <svg class="w-8 h-8 mx-auto text-green-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <p class="text-green-400 font-medium mb-1">Archivo seleccionado</p>
                        <p class="text-gray-400 text-sm">${file.name}</p>
                    `;
                }
            });
        });
    </script>
</x-emprendedor-layout>