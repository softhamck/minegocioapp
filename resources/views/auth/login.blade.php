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
                    Iniciar Sesión
                </h2>
                <p class="text-gray-400">Accede a tu cuenta</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 p-3 bg-blue-500/10 border border-blue-500/20 rounded-lg text-blue-400 text-sm" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="'Correo electrónico'" class="text-gray-300 mb-2 font-medium" />
                    <x-text-input id="email"
                        class="block w-full bg-gray-900/50 border-gray-600 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-lg px-4 py-3 transition-all duration-200"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="tu@email.com"
                        required autofocus
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="'Contraseña'" class="text-gray-300 mb-2 font-medium" />

                    <x-text-input id="password"
                        class="block w-full bg-gray-900/50 border-gray-600 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-lg px-4 py-3 transition-all duration-200"
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox"
                            class="rounded bg-gray-900/50 border-gray-600 text-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:ring-offset-gray-800 transition duration-200"
                            name="remember">
                        <span class="ms-3 text-sm text-gray-300 hover:text-white transition-colors">
                            Recordarme
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors duration-200 font-medium" 
                           href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="pt-4">
                    <x-primary-button class="w-full justify-center py-3.5 font-semibold bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-lg shadow-lg hover:shadow-indigo-500/25 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Ingresar
                    </x-primary-button>
                </div>
            </form>

            <!-- Registro -->
            <div class="mt-8 pt-6 border-t border-gray-700/50">
                <p class="text-center text-gray-400 text-sm">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="text-indigo-400 font-semibold hover:text-indigo-300 transition-colors duration-200 ml-1">
                        Crear una cuenta
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>