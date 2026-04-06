<div>
    <div class="flex items-center gap-2 mb-4">
        <div class="h-5 w-1 rounded-full bg-gradient-to-b from-[#E11D48] to-[#F43F5E]"></div>
        <h3 class="text-lg font-bold text-[#E11D48]">Eliminar Cuenta</h3>
    </div>
    
    <p class="text-sm text-[#6B7280] mb-3">
        Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente.
    </p>
    <p class="text-sm text-[#6B7280] mb-5">
        Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.
    </p>

    <!-- Botón que abre el modal de confirmación -->
    <div class="flex justify-end">
        <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="rounded-full bg-gradient-to-r from-[#E11D48] to-[#F43F5E] hover:from-[#BE123C] hover:to-[#E11D48] text-white px-6 py-2.5 transition-all duration-300 hover:shadow-[0_12px_30px_rgba(225,29,72,0.25)] font-medium">
            Eliminar Cuenta
        </button>
    </div>

    <!-- Modal de confirmación -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-[#1F2937]">
                ¿Estás segura de eliminar tu cuenta?
            </h2>

            <p class="mt-2 text-sm text-[#6B7280]">
                Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente. 
                Por favor, ingresa tu contraseña para confirmar que deseas eliminar tu cuenta permanentemente.
            </p>

            <div class="mt-4">
                <label class="block text-sm font-medium text-[#374151] mb-2">Contraseña</label>
                <input type="password" name="password" placeholder="••••••••"
                    class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#E11D48] focus:outline-none focus:ring-2 focus:ring-[#E11D48]/40 transition-all duration-200">

                @error('password', 'userDeletion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="rounded-full border border-[#E9D5FF] bg-white/80 px-4 py-2 text-[#374151] hover:bg-[#FAF5FF] transition-all duration-200 font-medium">
                    Cancelar
                </button>
                <button type="submit"
                    class="rounded-full bg-gradient-to-r from-[#E11D48] to-[#F43F5E] hover:from-[#BE123C] hover:to-[#E11D48] text-white px-4 py-2 transition-all duration-300 font-medium">
                    Eliminar Cuenta
                </button>
            </div>
        </form>
    </x-modal>
</div>