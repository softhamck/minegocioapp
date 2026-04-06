<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('rol_id', '!=', 1)->with('rol');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('rol_id', $request->role);
        }

        $users = $query->paginate(10)->appends($request->query());
        $roles = Role::where('id', '!=', 1)->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::where('id', '!=', 1)->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)  // ← AGREGAR Request $request
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:20',
            'rol_id'   => 'required|exists:roles,id',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'rol_id'   => $request->rol_id,
            'password' => Hash::make($request->password),
        ]);

        // Respuesta para AJAX (desde el modal)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario creado exitosamente',
                'user'    => $user
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)  // ← AGREGAR User $user
    {
        $roles = Role::where('id', '!=', 1)->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)  // ← AGREGAR Request $request y User $user
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => "required|email|unique:users,email,{$user->id}",
            'telefono' => 'nullable|string|max:20',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        // Si se envía contraseña, actualizarla
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $user->password = Hash::make($request->password);
        }

        $user->update($request->only('name', 'email', 'telefono', 'rol_id'));

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(Request $request, User $user)  // ← AGREGAR Request $request y User $user
    {
        // No permitir eliminar administradores
        if ($user->rol_id == 1) {
            return back()->with('error', 'No puedes eliminar un administrador');
        }

        // No permitir eliminar el propio usuario
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propio usuario');
        }

        $user->delete();

        return back()->with('success', 'Usuario eliminado correctamente');
    }
}