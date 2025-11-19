<x-emprendedor-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-white">
                    Editar Producto
                </h2>
                <p class="text-gray-400 text-sm">
                    {{ $business->name }} - Modifica la información del producto
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
                <form action="{{ route('emprendedor.business.products.update', [$business, $product]) }}"
                      method="POST" enctype="multipart/form-data"
                      class="space-y-8">

                    @csrf
                    @method('PUT')

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
                               value="{{ old('name', $product->name) }}"
                               placeholder="Ej: Camiseta Premium, Café Especial, etc."
                               class="w-full bg-gray-900/50 border-2 border-gray-600 text-white placeholder-gray-500 rounded-xl px-4 py-4 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-200 text-lg font-medium"
                               required
                               autofocus>
                        @error('name')
                            <p class="text-red-400 text-sm flex items-center mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 