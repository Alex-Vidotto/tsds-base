@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('crear usuario')
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Crear nuevo usuario</a>
    @endcan

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge bg-secondary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton-{{ $user->id }}" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton-{{ $user->id }}">
                                @can('ver usuario')
                                    <li><a class="dropdown-item" href="{{ route('users.show', $user) }}"><i class="fas fa-eye me-2"></i>Ver</a></li>
                                @endcan
                                @can('editar usuario')
                                    <li><a class="dropdown-item" href="{{ route('users.edit', $user) }}"><i class="fas fa-edit me-2"></i>Editar</a></li>
                                @endcan
                                @can('borrar usuario')
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar el usuario {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash-alt me-2"></i>Eliminar</button>
                                        </form>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection