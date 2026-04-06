<div>
    <div class="flex items-center gap-2 mb-4">
        <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
        <h3 class="text-lg font-bold text-[#1F2937]">Actualizar Contraseña</h3>
    </div>
    
    <p class="text-sm text-[#6B7280] mb-5">
        Asegúrate de usar una contraseña larga y segura para proteger tu cuenta.
    </p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <!-- Contraseña actual -->
        <div>
            <label class="block text-sm font-medium text-[#374151] mb-2">Contraseña actual</label>
            <input type="password" name="current_password" required
                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                placeholder="••••••••">
            @error('current_password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nueva contraseña -->
        <div>
            <label class="block text-sm font-medium text-[#374151] mb-2">Nueva contraseña</label>
            <input type="password" name="password" required
                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                placeholder="••••••••">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div>
            <label class="block text-sm font-medium text-[#374151] mb-2">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" required
                class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
                placeholder="••••••••">
        </div>

        <!-- Botón Guardar -->
        <div class="flex justify-end pt-2">
            <button type="submit"
                class="rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] hover:from-[#6D28D9] hover:to-[#EC4899] text-white px-6 py-2.5 transition-all duration-300 hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)] font-medium">
                Actualizar Contraseña
            </button>
        </div>
    </form>
</div>