<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">

            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Gestión de Usuarios
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section with Create Button -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-[#1F2937]">Usuarios Registrados</h1>
                    </div>
                    <p class="text-[#6B7280]">Gestiona todos los usuarios de la plataforma</p>
                </div>
                <a href="{{ route('admin.users.create') }}"
                   class="bg-gradient-to-r from-[#7C3AED] to-[#F472B6] hover:from-[#6D28D9] hover:to-[#EC4899] text-white px-6 py-3 rounded-full transition-all duration-300 hover:shadow-[0_16px_40px_rgba(124,58,237,0.28)] hover:-translate-y-0.5 font-medium inline-flex items-center justify-center sm:justify-start w-full sm:w-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Usuario
                </a>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="rounded-2xl border border-green-300/60 bg-green-50/80 backdrop-blur p-4 mb-6">
                    <div class="flex items-center text-green-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-2xl border border-red-300/60 bg-red-50/80 backdrop-blur p-4 mb-6">
                    <div class="flex items-center text-red-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Filters Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 p-6 backdrop-blur mb-6">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="relative">
                    <form method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-[#374151] mb-2">Buscar</label>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Nombre o email..." 
                                    class="w-full rounded-full border border-[#F3E8FF] bg-white/80 px-4 py-2 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-[#374151] mb-2">Filtrar por rol</label>
                                <select name="role" class="w-full rounded-full border border-[#F3E8FF] bg-white/80 px-4 py-2 text-[#1F2937] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200 cursor-pointer">
                                    <option value="">Todos los roles</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ request('role') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex gap-2 w-full sm:w-auto">
                            <button type="submit" 
                                    class="flex-1 sm:flex-none bg-gradient-to-r from-[#7C3AED] to-[#A78BFA] hover:from-[#6D28D9] hover:to-[#7C3AED] text-white px-4 py-2 rounded-full transition-all duration-200 font-medium flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Filtrar
                            </button>
                            
                            <a href="{{ route('admin.users.index') }}"
                               class="flex-1 sm:flex-none border border-[#E9D5FF] bg-white/80 hover:bg-[#FAF5FF] text-[#374151] px-4 py-2 rounded-full transition-all duration-200 font-medium flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Users Table Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                <div class="relative">
                    <!-- Mobile View -->
                    <div class="sm:hidden">
                        @forelse ($users as $user)
                        <div class="p-4 border-b border-[#F3E8FF]">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <div class="font-semibold text-[#1F2937]">{{ $user->name }}</div>
                                    <div class="text-sm text-[#6B7280]">{{ $user->email }}</div>
                                </div>
                                <span class="bg-gradient-to-r from-[#7C3AED]/20 to-[#F472B6]/20 text-[#7C3AED] text-xs px-2 py-1 rounded-full">
                                    {{ $user->rol->name }}
                                </span>
                            </div>
                            <div class="flex justify-end space-x-3 mt-3">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="text-[#7C3AED] hover:text-[#6D28D9] transition-colors text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Editar
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-[#E11D48] hover:text-[#BE123C] transition-colors text-sm font-medium flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="p-8 text-center text-[#6B7280]">
                            <svg class="w-12 h-12 mx-auto mb-4 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            No se encontraron usuarios
                        </div>
                        @endforelse
                    </div>

                    <!-- Desktop View -->
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#F5F3FF]/50 border-b border-[#F3E8FF]">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Usuario</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Rol</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#374151]">Email</th>
                                    <th class="px-6 py-4 text-right text-sm font-semibold text-[#374151]">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#F3E8FF]">
                                @forelse ($users as $user)
                                <tr class="hover:bg-[#FAF5FF]/50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="text-[#1F2937] font-medium">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-gradient-to-r from-[#7C3AED]/20 to-[#F472B6]/20 text-[#7C3AED] text-sm px-3 py-1 rounded-full">
                                            {{ $user->rol->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-[#6B7280]">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end space-x-3">
                                            <a href="{{ route('admin.users.edit', $user) }}" 
                                               class="text-[#7C3AED] hover:text-[#6D28D9] transition-colors font-medium text-sm flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-[#E11D48] hover:text-[#BE123C] transition-colors font-medium text-sm flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-[#6B7280]">
                                        <svg class="w-12 h-12 mx-auto mb-4 text-[#C4B5FD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                        </svg>
                                        No se encontraron usuarios
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                    <div class="px-6 py-4 border-t border-[#F3E8FF]">
                        <div class="flex justify-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL PARA CREAR USUARIO -->
<div id="createUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" onclick="closeCreateUserModal()"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom rounded-2xl text-left overflow-hidden shadow-[0_20px_60px_rgba(124,58,237,0.25)] transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="relative bg-white/95 backdrop-blur-xl border border-white/60 rounded-2xl">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative px-6 pt-6 pb-4">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-md">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-[#1F2937]">Crear Nuevo Usuario</h3>
                                <p class="text-sm text-[#6B7280]">Ingresa los datos del nuevo usuario</p>
                            </div>
                        </div>
                        <button onclick="closeCreateUserModal()" class="text-[#9CA3AF] hover:text-[#6B7280] transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Aquí se incluye el formulario reutilizable -->
                    <form method="POST" action="{{ route('admin.users.store') }}" id="createUserForm" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Nombre completo</label>
                            <input type="text" name="name" id="modal_name" required
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="Ej: María González">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Correo electrónico</label>
                            <input type="email" name="email" id="modal_email" required
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="usuario@ejemplo.com">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Contraseña</label>
                            <input type="password" name="password" id="modal_password" required
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="********">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="modal_password_confirmation" required
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                                placeholder="********">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#374151] mb-2">Rol</label>
                            <select name="rol_id" id="modal_rol_id" required
                                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
                                <option value="">Seleccionar rol</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-3 pt-2">
                            <button type="button" onclick="closeCreateUserModal()"
                                class="flex-1 rounded-full border border-[#E9D5FF] bg-white/80 px-4 py-2.5 text-[#374151] hover:bg-[#FAF5FF] transition-all duration-200 font-medium">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="flex-1 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] hover:from-[#6D28D9] hover:to-[#EC4899] text-white px-4 py-2.5 transition-all duration-300 hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)] font-medium">
                                <span id="submitBtnText">Crear Usuario</span>
                                <span id="submitBtnLoading" class="hidden">
                                    <svg class="inline w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Creando...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>