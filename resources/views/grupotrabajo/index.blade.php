@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Título -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">Gestión de Grupos de Trabajo</h2>
            <p class="text-muted">Control de cuadrillas, disponibilidad y asignación de tareas</p>
        </div>
    </div>

    <!-- Botón Nueva Cuadrilla -->
    <div class="mb-3 text-end">
        <a href="{{ route('grupos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Cuadrilla
        </a>
    </div>

    <!-- Filtros -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('grupos.index') }}" class="row g-3 align-items-center">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="activo">En actividad</option>
                        <option value="disponible">Disponible</option>
                        <option value="no_disponible">No disponible</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Buscar por nombre</label>
                    <input type="text" name="search" class="form-control" placeholder="Ej: Cuadrilla Norte">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="bi bi-search"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Listado de Cuadrillas -->
    <div class="row">
        @forelse ($cuadrillas as $cuadrilla)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">{{ $cuadrilla->nombre }}</h5>
                        <span class="badge 
                            @if($cuadrilla->estado == 'activo') bg-success 
                            @elseif($cuadrilla->estado == 'disponible') bg-info 
                            @else bg-secondary @endif">
                            {{ ucfirst($cuadrilla->estado) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <p><strong>Supervisor:</strong> {{ $cuadrilla->supervisor->nombre ?? 'No asignado' }}</p>
                        <p><strong>Integrantes:</strong> {{ $cuadrilla->empleados->count() }}</p>

                        <hr>

                        <p class="fw-semibold mb-1">Tareas asignadas:</p>
                        @if($cuadrilla->tareas->count() > 0)
                            <ul class="list-unstyled small">
                                @foreach($cuadrilla->tareas->take(3) as $tarea)
                                    <li>• {{ $tarea->descripcion }} 
                                        <span class="text-muted">({{ ucfirst($tarea->estado) }})</span>
                                    </li>
                                @endforeach
                            </ul>
                            @if($cuadrilla->tareas->count() > 3)
                                <a href="{{ route('grupos.show', $cuadrilla->id) }}" class="small text-primary">
                                    Ver todas las tareas →
                                </a>
                            @endif
                        @else
                            <p class="text-muted fst-italic">Sin tareas asignadas</p>
                        @endif
                    </div>
                    <div class="card-footer bg-light text-end">
                        <a href="{{ route('grupos.show', $cuadrilla->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i> Ver Detalle
                        </a>
                        <a href="{{ route('grupos.edit', $cuadrilla->id) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center mt-5">
                <p class="text-muted">No hay cuadrillas registradas.</p>
                <a href="{{ route('grupos.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Crear la primera cuadrilla
                </a>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $cuadrillas->links() }}
    </div>
</div>
@endsection
