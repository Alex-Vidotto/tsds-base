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
                   <form action="{{ route('grupotrabajos.update', ['grupotrabajo' => $grupoTrabajo->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre del Grupo</label>
                            <input type="text" name="nombre" id="nombre"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   value="{{ old('nombre', $grupoTrabajo->nombre) }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Auto Asignado -->
                        <div class="mb-3">
                            <label for="car_id" class="form-label fw-semibold">Auto Asignado</label>
                            <select name="car_id" id="car_id" class="form-select">
                                <option value="">-- Sin auto --</option>
                                @foreach($autos as $auto)
                                    <option value="{{ $auto->id }}" 
                                        {{ old('car_id', $grupoTrabajo->car_id) == $auto->id ? 'selected' : '' }}>
                                        {{ $auto->matricula }} - {{ $auto->carModel->carBrand->nombre }} {{ $auto->carModel->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Integrantes -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Integrantes del Grupo</label>
                            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                @foreach($empleados as $empleado)
                                    <div class="form-check">
                                        <input type="checkbox" name="empleados[]" 
                                               value="{{ $empleado->id }}" 
                                               id="empleado_{{ $empleado->id }}"
                                               class="form-check-input"
                                               {{ in_array($empleado->id, $grupoTrabajo->empleados->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label for="empleado_{{ $empleado->id }}" class="form-check-label">
                                            {{ $empleado->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('grupotrabajos.index') }}" class="btn btn-outline-secondary">
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
