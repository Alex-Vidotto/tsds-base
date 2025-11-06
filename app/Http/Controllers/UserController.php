<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver usuario', ['only' => ['index', 'show']]);
        $this->middleware('permission:crear usuario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar usuario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar usuario', ['only' => ['destroy']]);
    }

    // Mostrar listado de usuarios
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    // Mostrar formulario para crear usuario
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    // Guardar usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'rol' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar rol
        $user->assignRole($request->rol);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    // Mostrar usuario (opcional)
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Formulario para editar usuario
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|string|min:6|confirmed',
            'rol' => 'required|exists:roles,name',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Sincronizar rol
        $user->syncRoles([$request->rol]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
