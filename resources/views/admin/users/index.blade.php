<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">
            Gestión de Usuarios
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section with Create Button -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Usuarios Registrados</h1>
                    <p class="text-gray-400">Gestiona todos los usuarios de la plataforma</p>
                </div>
                <a href="{{ route('admin.users.create') }}"
                   class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-6 py-3 rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/25 font-medium inline-flex items-center justify-center sm:justify-start w-full sm:w-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Usuario
                </a>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="glass-card border border-green-500/30 bg-green-500/10 text-green-400 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="glass-card border border-red-500/30 bg-red-500/10 text-red-400 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Filters Card -->
            <div class="glass-card rounded-2xl p-6 mb-6">
                <form method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Buscar</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Nombre o email..." 
                                class="w-full bg-gray-900/50 border border-gray-600 text-white placeholder-gray-500 rounded-lg px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Filtrar por rol</label>
                            <select name="role" class="w-full bg-gray-900/50 border border-gray-600 text-white rounded-lg px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 cursor-pointer">
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
                                class="flex-1 sm:flex-none bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 font-medium flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Filtrar
                        </button>
                        
                        <a href="{{ route('admin.users.index') }}"
                           class="flex-1 sm:flex-none bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 font-medium flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Users Table Card -->
            <div class="glass-card rounded-2xl overflow-hidden">
                <!-- Mobile View -->
                <div class="sm:hidden">
                    @forelse ($users as $user)
                    <div class="p-4 border-b border-gray-700/50">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <div class="font-semibold text-white">{{ $user->name }}</div>
                                <div class="text-sm text-gray-400">{{ $user->email }}</div>
                            </div>
                            <span class="bg-indigo-500/20 text-indigo-300 text-xs px-2 py-1 rounded-full">
                                {{ $user->rol->name }}
                            </span>
                        </div>
                        <div class="flex justify-end space-x-2 mt-3">
                            <a href="{{ route('admin.users.edit', $user) }}" 
                               class="text-blue-400 hover:text-blue-300 transition-colors text-sm font-medium flex items-center">
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
                                        class="text-red-400 hover:text-red-300 transition-colors text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        No se encontraron usuarios
                    </div>
                    @endforelse
                </div>

                <!-- Desktop View -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Usuario</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Rol</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Email</th>
                                <th class="px-6 py-4 text-right text-sm font-medium text-gray-300">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700/50">
                            @forelse ($users as $user)
                            <tr class="hover:bg-gray-800/30 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="text-white font-medium">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-indigo-500/20 text-indigo-300 text-sm px-3 py-1 rounded-full">
                                        {{ $user->rol->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-300">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="text-blue-400 hover:text-blue-300 transition-colors font-medium text-sm flex items-center">
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
                                                    class="text-red-400 hover:text-red-300 transition-colors font-medium text-sm flex items-center">
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
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="px-6 py-4 border-t border-gray-700/50">
                    <div class="flex justify-center">
                        {{ $users->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>