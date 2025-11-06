
@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Detalle del Grupo de Trabajo: {{ $grupoTrabajo->nombre }}</h1>

    {{-- Auto asignado --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">
            Auto Asignado
        </div>
        <div class="card-body">
            @if($grupoTrabajo->auto)
                <p><strong>Matrícula:</strong> {{ $grupoTrabajo->auto->matricula }}</p>
                <p><strong>Modelo:</strong> {{ $grupoTrabajo->auto->carModel->carBrand->nombre }} {{ $grupoTrabajo->auto->carModel->nombre }}</p>
            @else
                <p class="text-muted">No hay auto asignado a este grupo.</p>
            @endif
        </div>
    </div>

    {{-- Empleados --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            Empleados del Grupo
        </div>
        <div class="card-body">
            @if($grupoTrabajo->empleados->count() > 0)
                <ul class="list-group">
                    @foreach($grupoTrabajo->empleados as $empleado)
                        <li class="list-group-item">
                            {{ $empleado->name }}
                            <span class="text-muted">({{ $empleado->getRoleNames()->join(', ') }})</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay empleados asignados.</p>
            @endif
        </div>
    </div>

    {{-- Tareas --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-dark">
            Tareas Asignadas
        </div>
        <div class="card-body">
            @if($grupoTrabajo->tareas->count() > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupoTrabajo->tareas as $tarea)
                            <tr>
                                <td>{{ $tarea->titulo }}</td>
                                <td>{{ $tarea->pivot->cliente }}</td>
                                <td>
                                    <span class="badge 
                                        @if($tarea->pivot->estado == 'completado') bg-success 
                                        @elseif($tarea->pivot->estado == 'pendiente') bg-danger 
                                        @else bg-secondary @endif">
                                        {{ ucfirst(str_replace('_', ' ', $tarea->pivot->estado)) }}
                                    </span>
                                </td>
                                <td>${{ number_format($tarea->pivot->costo_final, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No hay tareas registradas para este grupo.</p>
            @endif
        </div>
    </div>

    {{-- Botón de volver --}}
    <div class="text-center">
        <a href="{{ route('grupotrabajos.index') }}" class="btn btn-outline-secondary">← Volver al listado</a>
    </div>
</div>
@endsection
