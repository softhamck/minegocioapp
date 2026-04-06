<x-guest-layout>
    <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.35),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.20),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] px-6 py-10">

        <!-- Decorative blur -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/40 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/20 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/40 blur-3xl"></div>

        <div class="relative z-10 flex min-h-[calc(100vh-5rem)] items-center justify-center">
            <div class="w-full max-w-md">

                <!-- Brand -->
                <div class="mb-8 text-center">
                    <div class="mb-5 flex items-center justify-center gap-3">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_12px_30px_rgba(124,58,237,0.22)]">
                            <span class="text-lg font-bold text-white">MN</span>
                        </div>
                    </div>

                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-[#7C3AED]">
                        MiNegocioApp
                    </p>

                    <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-[#1F2937]">
                        Crea tu cuenta
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-[#6B7280]">
                        Únete y empieza a impulsar tu negocio con una experiencia clara, elegante y profesional.
                    </p>
                </div>

                <!-- Card -->
                <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/70 p-8 shadow-[0_20px_60px_rgba(124,58,237,0.12)] backdrop-blur-xl">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Nombre -->
                        <div>
                            <x-input-label
                                for="name"
                                :value="'Nombre completo'"
                                class="mb-2 block text-sm font-semibold text-[#374151]"
                            />

                            <x-text-input
                                id="name"
                                class="block w-full rounded-2xl border border-[#E9D5FF] bg-white/90 px-4 py-3.5 text-[#1F2937] placeholder-[#9CA3AF] shadow-sm transition duration-200 focus:border-[#C4B5FD] focus:ring-4 focus:ring-[#C4B5FD]/25"
                                type="text"
                                name="name"
                                :value="old('name')"
                                placeholder="Tu nombre completo"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-[#E11D48]" />
                        </div>

                        <!-- Rol -->
                        <div>
                            <x-input-label
                                for="rol_id"
                                :value="'Tipo de usuario'"
                                class="mb-2 block text-sm font-semibold text-[#374151]"
                            />

                            <select
                                id="rol_id"
                                name="rol_id"
                                class="block w-full cursor-pointer rounded-2xl border border-[#E9D5FF] bg-white/90 px-4 py-3.5 text-[#1F2937] shadow-sm transition duration-200 focus:border-[#C4B5FD] focus:ring-4 focus:ring-[#C4B5FD]/25"
                            >
                                <option value="2">🚀 Emprendedora</option>
                                <option value="3">👥 Cliente</option>
                            </select>

                            <x-input-error :messages="$errors->get('rol_id')" class="mt-2 text-sm text-[#E11D48]" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label
                                for="email"
                                :value="'Correo electrónico'"
                                class="mb-2 block text-sm font-semibold text-[#374151]"
                            />

                            <x-text-input
                                id="email"
                                class="block w-full rounded-2xl border border-[#E9D5FF] bg-white/90 px-4 py-3.5 text-[#1F2937] placeholder-[#9CA3AF] shadow-sm transition duration-200 focus:border-[#C4B5FD] focus:ring-4 focus:ring-[#C4B5FD]/25"
                                type="email"
                                name="email"
                                :value="old('email')"
                                placeholder="tu@email.com"
                                required
                                autocomplete="username"
                            />

                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-[#E11D48]" />
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <x-input-label
                                for="password"
                                :value="'Contraseña'"
                                class="mb-2 block text-sm font-semibold text-[#374151]"
                            />

                            <x-text-input
                                id="password"
                                class="block w-full rounded-2xl border border-[#E9D5FF] bg-white/90 px-4 py-3.5 text-[#1F2937] placeholder-[#9CA3AF] shadow-sm transition duration-200 focus:border-[#C4B5FD] focus:ring-4 focus:ring-[#C4B5FD]/25"
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            />

                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-[#E11D48]" />
                        </div>

                        <!-- Confirmar contraseña -->
                        <div>
                            <x-input-label
                                for="password_confirmation"
                                :value="'Confirmar contraseña'"
                                class="mb-2 block text-sm font-semibold text-[#374151]"
                            />

                            <x-text-input
                                id="password_confirmation"
                                class="block w-full rounded-2xl border border-[#E9D5FF] bg-white/90 px-4 py-3.5 text-[#1F2937] placeholder-[#9CA3AF] shadow-sm transition duration-200 focus:border-[#C4B5FD] focus:ring-4 focus:ring-[#C4B5FD]/25"
                                type="password"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-[#E11D48]" />
                        </div>

                        <!-- Button -->
                        <div class="pt-3">
                            <x-primary-button class="flex w-full items-center justify-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3.5 text-sm font-semibold text-white shadow-[0_16px_40px_rgba(124,58,237,0.25)] transition duration-300 hover:-translate-y-0.5 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_20px_50px_rgba(124,58,237,0.30)]">
                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Crear cuenta
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Login link -->
                    <div class="mt-8 border-t border-[#F3E8FF] pt-6 text-center">
                        <p class="text-sm text-[#6B7280]">
                            ¿Ya tienes cuenta?
                            <a
                                href="{{ route('login') }}"
                                class="ml-1 font-semibold text-[#F472B6] transition hover:text-[#EC4899]"
                            >
                                Iniciar sesión
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Extra footer text -->
                <p class="mt-6 text-center text-xs leading-6 text-[#9CA3AF]">
                    Diseñado para emprendedoras que quieren una presencia digital más cálida, moderna y memorable.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>