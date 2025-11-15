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
        $query = User::where('rol_id','!=',1)->with('rol');

        if ($request->filled('search')){
            $query->where(function($q) use ($request){
                $q->where('name','LIKE','%'.$request->search.'%')
                  ->orWhere('email', 'LIKE', '%'.$request->search.'%');

            }); 
        }

        
        if ($request->filled('role')) {
            $query->where('rol_id', $request->role);
        }

        $users = $query->paginate(10)->appends($request->query());
        $roles = Role::where('id','!=',1)->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create() {

        $roles = Role::where('id','!=',1)->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store() {
         $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:20',
            'rol_id'   => 'required|exists:roles,id',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'rol_id' => $request->rol_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function edit() {
         $roles = Role::where('id','!=',1)->get();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update() {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => "required|email|unique:users,email,{$user->id}",
            'telefono' => 'nullable|string|max:20',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        $user->update($request->only('name','email','telefono','rol_id'));

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy() {
         if ($user->rol_id == 1) {
            return back()->with('error', 'No puedes eliminar un administrador');
        }

        $user->delete();

        return back()->with('success', 'Usuario eliminado correctamente');
    }
}
