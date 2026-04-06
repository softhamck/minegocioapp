<div>
    <div class="flex items-center gap-2 mb-4">
        <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
        <h3 class="text-lg font-bold text-[#1F2937]">Información del Perfil</h3>
    </div>
    
    <p class="text-sm text-[#6B7280] mb-5">
        Actualiza la información de tu cuenta y correo electrónico.
    </p>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <label class="block text-sm font-medium text-[#374151] mb-2">Nombre completo</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-[#374151] mb-2">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Verificación de email (si aplica) -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="text-sm text-[#EC4899]">
                <p>Tu correo electrónico no está verificado.</p>
                <button type="button" form="send-verification"
                    class="mt-2 text-[#7C3AED] hover:text-[#6D28D9] underline transition-colors">
                    Reenviar verificación
                </button>
            </div>
        @endif

        <!-- Botón Guardar -->
        <div class="flex justify-end pt-2">
            <button type="submit"
                class="rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] hover:from-[#6D28D9] hover:to-[#EC4899] text-white px-6 py-2.5 transition-all duration-300 hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)] font-medium">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>