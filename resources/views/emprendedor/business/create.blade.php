<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div>
                <h2 class="text-xl font-semibold text-white">
                    Crear Nuevo Negocio
                </h2>
                <p class="text-gray-400 text-sm mt-1">
                    Completa la información de tu nuevo establecimiento
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button - MOVIDO FUERA DEL HEADER -->
            <div class="mb-6">
                <a href="{{ route('emprendedor.business.index') }}" 
                   class="inline-flex items-center glass-card border border-gray-600 hover:border-gray-500 text-gray-300 hover:text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a Mis Negocios
                </a>
            </div>

            <!-- Progress Steps -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-white">Información del Negocio</h3>
                    <span class="text-indigo-400 text-sm font-medium">Paso 1 de 1</span>
                </div>
                
                <div class="flex items-center mb-8">
                    <div class="flex items-center justify-center w-8 h-8 bg-indigo-600 rounded-full">
                        <span class="text-white text-sm font-bold">1</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-600 mx-4"></div>
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-600 rounded-full">
                        <span class="text-gray-400 text-sm font-bold">2</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-600 mx-4"></div>
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-600 rounded-full">
                        <span class="text-gray-400 text-sm font-bold">3</span>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="glass-card rounded-2xl p-6">
                <form action="{{ route('emprendedor.business.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nombre del Negocio -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            Nombre del Negocio *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="name"
                                name="name" 
                                value="{{ old('name') }}"
                                placeholder="Ej: Mi Tienda Online, Restaurante Familiar, etc."
                                class="w-full bg-gray-900/50 border border-gray-600 text-white placeholder-gray-500 rounded-lg pl-10 pr-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200"
                                required
                                autofocus
                            >
                        </div>
                        @error('name')
                            <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-gray-500 text-xs">El nombre debe ser único y representativo de tu negocio</p>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                            Descripción del Negocio *
                        </label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                            <textarea 
                                id="description"
                                name="description" 
                                rows="4"
                                placeholder="Describe tu negocio, los productos o servicios que ofreces, tu misión, etc."
                                class="w-full bg-gray-900/50 border border-gray-600 text-white placeholder-gray-500 rounded-lg pl-10 pr-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 resize-none"
                                required
                            >{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                        <div class="flex justify-between mt-1">
                            <p class="text-gray-500 text-xs">Sé específico para atraer a tus clientes ideales</p>
                            <span id="charCount" class="text-gray-500 text-xs">0/500</span>
                        </div>
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-300 mb-2">
                            Teléfono de Contacto *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <input 
                                type="tel" 
                                id="telephone"
                                name="telephone" 
                                value="{{ old('telephone') }}"
                                placeholder="Ej: +57 300 123 4567"
                                class="w-full bg-gray-900/50 border border-gray-600 text-white placeholder-gray-500 rounded-lg pl-10 pr-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200"
                                required
                            >
                        </div>
                        @error('telephone')
                            <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-gray-500 text-xs">Incluye código de país para clientes internacionales</p>
                    </div>

                    <!-- Dirección -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-300 mb-2">
                            Dirección del Establecimiento
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="address"
                                name="address" 
                                value="{{ old('address') }}"
                                placeholder="Ej: Calle 123 #45-67, Ciudad, País"
                                class="w-full bg-gray-900/50 border border-gray-600 text-white placeholder-gray-500 rounded-lg pl-10 pr-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200"
                            >
                        </div>
                        @error('address')
                            <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-gray-500 text-xs">Opcional - Para negocios con ubicación física</p>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-700/50">
                        <button 
                            type="submit"
                            class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-8 py-3 rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-green-500/25 font-semibold flex items-center justify-center flex-1"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Crear Negocio
                        </button>
                        
                        <a 
                            href="{{ route('emprendedor.business.index') }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-lg transition-colors duration-200 font-semibold flex items-center justify-center flex-1"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tips Card -->
            <div class="glass-card rounded-2xl p-6 mt-6">
                <h4 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Consejos para tu Negocio
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-500/20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-blue-400 text-xs">1</span>
                        </div>
                        <p class="text-gray-400">Usa un nombre memorable y fácil de recordar para tus clientes</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-500/20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-blue-400 text-xs">2</span>
                        </div>
                        <p class="text-gray-400">Sé claro en la descripción sobre lo que ofrece tu negocio</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-500/20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-blue-400 text-xs">3</span>
                        </div>
                        <p class="text-gray-400">Incluye un teléfono activo para que los clientes te contacten</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-500/20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-blue-400 text-xs">4</span>
                        </div>
                        <p class="text-gray-400">La dirección ayuda a clientes locales a encontrarte fácilmente</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Contador de caracteres para la descripción
        document.addEventListener('DOMContentLoaded', function() {
            const descriptionTextarea = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            
            descriptionTextarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = `${length}/500`;
                
                if (length > 450) {
                    charCount.classList.add('text-yellow-400');
                    charCount.classList.remove('text-gray-500');
                } else {
                    charCount.classList.remove('text-yellow-400');
                    charCount.classList.add('text-gray-500');
                }
            });
            
            // Trigger initial count
            descriptionTextarea.dispatchEvent(new Event('input'));
            
            // Validación en tiempo real
            const inputs = document.querySelectorAll('input[required], textarea[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (!this.value.trim()) {
                        this.classList.add('border-red-500');
                    } else {
                        this.classList.remove('border-red-500');
                    }
                });
            });
        });
    </script>
</x-emprendedor-layout>