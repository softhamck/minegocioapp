<x-guest-layout>
    <!-- Contenedor principal -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-[#0f0f23] via-[#1a1a2e] to-[#16213e] p-6">

        <div class="w-full max-w-md bg-gray-800/80 backdrop-blur-sm shadow-2xl rounded-2xl p-8 border border-gray-700/50">
            
            <!-- Logo y Título -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-lg">MN</span>
                    </div>
                    <span class="text-2xl font-bold text-white">MiNegocioApp</span>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">
                    Crear Cuenta
                </h2>
                <p class="text-gray-400">Únete a nuestra comunidad</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Nombre -->
                <div>
                    <x-input-label for="name" :value="'Nombre completo'" class="text-gray-300 mb-2 font-medium" />
                    <x-text-input id="name"
                        class="block w-full bg-gray-900/50 border-gray-600 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-lg px-4 py-3 transition-all duration-200"
                        type="text"
                        name="name"
                        :value="old('name')"
                        placeholder="Tu nombre completo"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Rol -->
                <div>
                    <x-input-label for="rol_id" :value="'Tipo de usuario'" class="text-gray-300 mb-2 font-medium" />
                    <select id="rol_id" name="rol_id"
                        class="block w-full bg-gray-900/50 border-gray-600 text-white rounded-lg px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 cursor-pointer">
                        <option value="2" class="bg-gray-800 py-2">🚀 Emprendedor</option>
                        <option value="3" class="bg-gray-800 py-2">👥 Cliente</option>
                    </select>
                    <x-input-error :messages="$errors->get('rol_id')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="'Correo electrónico'" class="text-gray-300 mb-2 font-medium" />
                    <x-text-input id="email"
                        class="block w-full bg-gray-900/50 border-gray-600 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-lg px-4 py-3 transition-all duration-200"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="tu@email.com"
                        required
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Contraseña -->
                <div>
                    <x-input-label for="password" :value="'Contraseña'" class="text-gray-300 mb-2 font-medium" />
                    <x-text-input id="password"
                        class="block w-full bg-gray-900/50 border-gray-600 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-lg px-4 py-3 transition-all duration-200"
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <x-input-label for="password_confirmation" :value="'Confirmar contraseña'" class="text-gray-300 mb-2 font-medium" />
                    <x-text-input id="password_confirmation"
                        class="block w-full bg-gray-900/50 border-gray-600 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-lg px-4 py-3 transition-all duration-200"
                        type="password"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Botón registrar -->
                <div class="pt-4">
                    <x-primary-button class="w-full justify-center py-3.5 font-semibold bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-lg shadow-lg hover:shadow-indigo-500/25 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Crear Cuenta
                    </x-primary-button>
                </div>
            </form>

            <!-- Link de login -->
            <div class="mt-8 pt-6 border-t border-gray-700/50">
                <p class="text-center text-gray-400 text-sm">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="text-indigo-400 font-semibold hover:text-indigo-300 transition-colors duration-200 ml-1">
                        Iniciar sesión
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>