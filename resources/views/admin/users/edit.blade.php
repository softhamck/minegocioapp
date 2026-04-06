<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_12px_30px_rgba(124,58,237,0.22)]">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Editar Usuario
                </h2>
                <p class="text-sm text-[#6B7280]">
                    Actualiza la información del usuario
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10 px-4 sm:px-6">
        <div class="max-w-2xl mx-auto">
            <!-- Form Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <!-- Elementos decorativos -->
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Información del Usuario</h3>
                    </div>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Nombre completo</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="Ej: María González">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Correo electrónico</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="usuario@ejemplo.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono (opcional) -->
                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Teléfono (opcional)</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}"
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="Ej: 3001234567">
                            @error('telefono')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contraseña (opcional) -->
                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">
                                Contraseña
                                <span class="text-xs text-[#9CA3AF] font-normal">(dejar en blanco para no cambiar)</span>
                            </label>
                            <input type="password" name="password"
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="********">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmar contraseña -->
                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation"
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="********">
                        </div>

                        <!-- Rol -->
                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Rol</label>
                            <select name="rol_id" required
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
                                <option value="">Seleccionar rol</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ (old('rol_id', $user->rol_id) == $role->id) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rol_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-3 pt-4">
                            <a href="{{ route('admin.users.index') }}"
                                class="flex-1 rounded-full border border-[#E9D5FF] bg-white/80 px-4 py-2.5 text-center text-[#374151] hover:bg-[#FAF5FF] transition-all duration-200 font-medium">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="flex-1 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] hover:from-[#6D28D9] hover:to-[#EC4899] text-white px-4 py-2.5 transition-all duration-300 hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)] font-medium">
                                Actualizar Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>