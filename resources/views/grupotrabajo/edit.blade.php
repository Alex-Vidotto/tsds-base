@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Título -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">Editar Cuadrilla</h2>
            <p class="text-muted">Modifica la información de la cuadrilla de trabajo</p>
        </div>
    </div>

    <!-- Formulario de edición -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('grupos.update', $cuadrilla->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre de la Cuadrilla</label>
                            <input type="text" name="nombre" id="nombre" 
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   value="{{ old('nombre', $cuadrilla->nombre) }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Supervisor -->
                        <div class="mb-3">
                            <label for="supervisor_id" class="form-label fw-semibold">Supervisor</label>
                            <select name="supervisor_id" id="supervisor_id" class="form-select">
                                <option value="">-- Seleccionar supervisor --</option>
                                @foreach($supervisores as $supervisor)
                                    <option value="{{ $supervisor->id }}" 
                                        {{ $cuadrilla->supervisor_id == $supervisor->id ? 'selected' : '' }}>
                                        {{ $supervisor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="estado" class="form-label fw-semibold">Estado</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="activo" {{ $cuadrilla->estado == 'activo' ? 'selected' : '' }}>En actividad</option>
                                <option value="disponible" {{ $cuadrilla->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="no_disponible" {{ $cuadrilla->estado == 'no_disponible' ? 'selected' : '' }}>No disponible</option>
                            </select>
                        </div>

                        <!-- Integrantes -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Integrantes de la Cuadrilla</label>
                            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                @foreach($empleados as $empleado)
                                    <div class="form-check">
                                        <input type="checkbox" name="empleados[]" 
                                               value="{{ $empleado->id }}" 
                                               id="empleado_{{ $empleado->id }}"
                                               class="form-check-input"
                                               {{ in_array($empleado->id, $cuadrilla->empleados->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label for="empleado_{{ $empleado->id }}" class="form-check-label">
                                            {{ $empleado->nombre }} ({{ $empleado->rol }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tareas asignadas -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tareas Asignadas</label>
                            @if($cuadrilla->tareas->count() > 0)
                                <ul class="list-group mb-3">
                                    @foreach($cuadrilla->tareas as $tarea)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $tarea->descripcion }}
                                            <span class="badge bg-secondary">{{ ucfirst($tarea->estado) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted fst-italic">Sin tareas asignadas actualmente.</p>
                            @endif
                            <a href="{{ route('tareas.create', ['cuadrilla_id' => $cuadrilla->id]) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Asignar nueva tarea
                            </a>
                        </div>

                        <hr>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('grupos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
