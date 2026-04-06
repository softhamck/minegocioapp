<form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" 
      class="space-y-5" id="userForm">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif

    <div>
        <label class="block text-sm font-medium text-[#374151] mb-2">Nombre completo</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required
            class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
            placeholder="Ej: María González">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[#374151] mb-2">Correo electrónico</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
            class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
            placeholder="usuario@ejemplo.com">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[#374151] mb-2">Contraseña</label>
        <input type="password" name="password" {{ isset($user) ? '' : 'required' }}
            class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
            placeholder="********">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[#374151] mb-2">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" {{ isset($user) ? '' : 'required' }}
            class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] placeholder:text-[#9CA3AF] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200"
            placeholder="********">
    </div>

    <div>
        <label class="block text-sm font-medium text-[#374151] mb-2">Rol</label>
        <select name="rol_id" required
            class="w-full rounded-xl border border-[#F3E8FF] bg-white/80 px-4 py-2.5 text-[#1F2937] focus:border-[#C4B5FD] focus:outline-none focus:ring-2 focus:ring-[#C4B5FD]/40 transition-all duration-200">
            <option value="">Seleccionar rol</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ (old('rol_id', $user->rol_id ?? '') == $role->id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @error('rol_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-3 pt-4">
        <a href="{{ route('admin.users.index') }}"
            class="flex-1 rounded-full border border-[#E9D5FF] bg-white/80 px-4 py-2.5 text-center text-[#374151] hover:bg-[#FAF5FF] transition-all duration-200 font-medium">
            Cancelar
        </a>
        <button type="submit"
            class="flex-1 rounded-full bg-gradient-to-r from-[#7C3AED] to-[#F472B6] hover:from-[#6D28D9] hover:to-[#EC4899] text-white px-4 py-2.5 transition-all duration-300 hover:shadow-[0_12px_30px_rgba(124,58,237,0.25)] font-medium">
            {{ isset($user) ? 'Actualizar Usuario' : 'Crear Usuario' }}
        </button>
    </div>
</form>