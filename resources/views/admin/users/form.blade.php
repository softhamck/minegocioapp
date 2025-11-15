@csrf 
<div class="space-y-3">
    <div>
        <label class="block">Nombre</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-1"
               value="{{ old('name', $user->name ?? '') }}">
    </div>

    <div>
        <label class="block">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-1"
               value="{{ old('email', $user->email ?? '') }}">
    </div>

    <div>
        <label class="block">Teléfono</label>
        <input type="text" name="telefono" class="w-full border rounded px-3 py-1"
               value="{{ old('telefono', $user->telefono ?? '') }}">
    </div>

    <div>
        <label class="block">Rol</label>
        <select name="rol_id" class="w-full border rounded px-3 py-1">
            @foreach($roles as $role)
                <option value="{{ $role->id }}"
                    @selected(old('rol_id', $user->rol_id ?? '') == $role->id)>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    @if (!isset($user))
        <div>
            <label class="block">Contraseña</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-1">
        </div>
    @endif
</div>

<button class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Guardar</button>
