<x-guest-layout>
    <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(196,181,253,0.35),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(244,114,182,0.20),_transparent_30%),linear-gradient(135deg,#FDF4FF_0%,#FCF7FF_45%,#FFF7FB_100%)] px-6 py-10">

        <!-- Decorative blur -->
        <div class="pointer-events-none absolute -top-16 -left-16 h-72 w-72 rounded-full bg-[#C4B5FD]/40 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 -right-20 h-80 w-80 rounded-full bg-[#F472B6]/20 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#E9D5FF]/40 blur-3xl"></div>

        <div class="relative z-10 flex min-h-[calc(100vh-5rem)] items-center justify-center">
            <div class="w-full max-w-md">

                <!-- Header -->
                <div class="mb-8 text-center">
                    <div class="mb-5 flex justify-center">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[#7C3AED] via-[#A78BFA] to-[#F472B6] shadow-[0_12px_30px_rgba(124,58,237,0.22)]">
                            <span class="text-lg font-bold text-white">MN</span>
                        </div>
                    </div>

                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-[#7C3AED]">
                        MiNegocioApp
                    </p>

                    <h2 class="mt-4 text-3xl font-extrabold text-[#1F2937]">
                        Recupera tu acceso
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-[#6B7280]">
                        Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
                    </p>
                </div>

                <!-- Card -->
                <div class="rounded-[2rem] border border-white/70 bg-white/70 p-8 shadow-[0_20px_60px_rgba(124,58,237,0.12)] backdrop-blur-xl">

                    <!-- Session Status -->
                    <x-auth-session-status
                        class="mb-5 rounded-2xl border border-[#DDD6FE] bg-[#F5F3FF] px-4 py-3 text-sm text-[#6D28D9]"
                        :status="session('status')"
                    />

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                        @csrf

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
                                autofocus
                            />

                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-[#E11D48]" />
                        </div>

                        <!-- Button -->
                        <div class="pt-2">
                            <x-primary-button class="flex w-full items-center justify-center rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] px-6 py-3.5 text-sm font-semibold text-white shadow-[0_16px_40px_rgba(124,58,237,0.25)] transition duration-300 hover:-translate-y-0.5 hover:from-[#6D28D9] hover:to-[#EC4899] hover:shadow-[0_20px_50px_rgba(124,58,237,0.30)]">
                                Enviar enlace de recuperación
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Back to login -->
                    <div class="mt-8 border-t border-[#F3E8FF] pt-6 text-center">
                        <a
                            href="{{ route('login') }}"
                            class="text-sm font-semibold text-[#F472B6] transition hover:text-[#EC4899]"
                        >
                            ← Volver a iniciar sesión
                        </a>
                    </div>
                </div>

                <!-- Footer text -->
                <p class="mt-6 text-center text-xs text-[#9CA3AF]">
                    Te ayudamos a volver a tu espacio de trabajo de forma segura.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>