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

    <div class="row">
        @forelse($grupos as $grupo)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                        <h5 class="mb-0">{{ $grupo->nombre }}</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton-{{ $grupo->id }}" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton-{{ $grupo->id }}">
                                <li><a class="dropdown-item" href="{{ route('grupotrabajos.show', $grupo) }}"><i class="fas fa-eye me-2"></i>Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('grupotrabajos.edit', ['grupotrabajo' => $grupo]) }}"><i class="fas fa-edit me-2"></i>Editar</a></li>
                                <li><a class="dropdown-item" href="{{ route('grupotrabajos.formAsignarTarea', $grupo) }}"><i class="fas fa-tasks me-2"></i>Asignar Tarea</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('grupotrabajos.destroy', $grupo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar el grupo {{ $grupo->nombre }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash-alt me-2"></i>Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><i class="fas fa-car me-2 text-muted"></i> <strong>Auto:</strong> {{ $grupo->auto->matricula ?? 'Sin auto asignado' }}</p>
                        
                        <div class="mb-2">
                            <i class="fas fa-users me-2 text-muted"></i> <strong>Empleados:</strong>
                            <div>
                                @forelse($grupo->empleados as $empleado)
                                    <span class="badge bg-secondary fw-normal">{{ $empleado->name }}</span>
                                @empty
                                    <em class="text-muted small">Sin empleados</em>
                                @endforelse
                            </div>
                        </div>

                        <div>
                            <i class="fas fa-clipboard-list me-2 text-muted"></i> <strong>Tareas:</strong>
                            @if($grupo->tareas->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($grupo->tareas->take(3) as $tarea)
                                        <li class="list-group-item px-0 py-1 border-0">{{ $tarea->titulo }} <small class="text-muted">({{ $tarea->pivot->cliente }})</small></li>
                                    @endforeach
                                    @if($grupo->tareas->count() > 3)
                                        <li class="list-group-item px-0 py-1 border-0 text-muted small">...y {{ $grupo->tareas->count() - 3 }} más.</li>
                                    @endif
                                </ul>
                            @else
                                <em class="text-muted small">Sin tareas</em>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <p class="card-text text-muted">No hay grupos de trabajo registrados todavía.</p>
                        <a href="{{ route('grupotrabajos.create') }}" class="btn btn-primary">Crear el Primer Grupo</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection