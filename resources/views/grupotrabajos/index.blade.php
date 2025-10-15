@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Grupos de Trabajo</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3" style="text-align: right;">
        <a href="{{ route('grupotrabajos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Cuadrilla
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Auto asignado</th>
                <th>Empleados</th>
                <th>Tareas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->nombre }}</td>
                    <td>{{ $grupo->auto->matricula ?? 'Sin auto' }}</td>
                    <td>
                        @forelse($grupo->empleados as $empleado)
                            <span class="badge bg-secondary">{{ $empleado->name }}</span>
                        @empty
                            <em>Sin empleados</em>
                        @endforelse
                    </td>
                    <td>
                        @forelse($grupo->tareas as $tarea)
                            <span class="badge bg-info">{{ $tarea->titulo }}</span>
                        @empty
                            <em>Sin tareas</em>
                        @endforelse
                        @if($grupo->tareas->count() >= 5)
                            <div class="text-danger small mt-1">Límite alcanzado</div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('grupotrabajos.show', $grupo) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                        <a href="{{ route('grupotrabajos.edit', $grupo) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                        <form action="{{ route('grupotrabajos.destroy', $grupo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este grupo?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay grupos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection