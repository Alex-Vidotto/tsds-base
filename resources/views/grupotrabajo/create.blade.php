@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Título -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">Nueva Cuadrilla de Trabajo</h2>
            <p class="text-muted">Crea una nueva cuadrilla y asigna su equipo de trabajo</p>
        </div>
    </div>

    <!-- Formulario -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('grupos.store') }}" method="POST">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre de la Cuadrilla</label>
                            <input type="text" name="nombre" id="nombre"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   placeholder="Ejemplo: Cuadrilla Norte o Grupo Instalaciones 1"
                                   value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Supervisor -->
                        <div class="mb-3">
                            <label for="supervisor_id" class="form-label fw-semibold">Supervisor</label>
                            <select name="supervisor_id" id="supervisor_id"
                                    class="form-select @error('supervisor_id') is-invalid @enderror" required>
                                <option value="">-- Seleccionar supervisor --</option>
                                @foreach($supervisores as $supervisor)
                                    <option value="{{ $supervisor->id }}"
                                        {{ old('supervisor_id') == $supervisor->id ? 'selected' : '' }}>
                                        {{ $supervisor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supervisor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="estado" class="form-label fw-semibold">Estado Inicial</label>
                            <select name="estado" id="estado"
                                    class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>En actividad</option>
                                <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="no_disponible" {{ old('estado') == 'no_disponible' ? 'selected' : '' }}>No disponible</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                               {{ (is_array(old('empleados')) && in_array($empleado->id, old('empleados'))) ? 'checked' : '' }}>
                                        <label for="empleado_{{ $empleado->id }}" class="form-check-label">
                                            {{ $empleado->nombre }} ({{ $empleado->rol }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('empleados')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tarea Inicial (opcional) -->
                        <div class="mb-3">
                            <label for="tarea_inicial" class="form-label fw-semibold">Tarea Inicial (opcional)</label>
                            <textarea name="tarea_inicial" id="tarea_inicial" rows="3"
                                      class="form-control"
                                      placeholder="Ejemplo: Instalación de red en cliente Zonasur">{{ old('tarea_inicial') }}</textarea>
                        </div>

                        <hr>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('grupos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Crear Cuadrilla
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
