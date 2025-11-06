@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Título -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">Asignar Tarea a {{ $grupo->nombre }}</h2>
            <p class="text-muted">Selecciona una tarea y completa los detalles para asignarla a este grupo de trabajo.</p>
        </div>
    </div>

    <!-- Formulario -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                   <form action="{{ route('grupotrabajos.asignarTarea', ['grupo' => $grupo->id]) }}" method="POST">
                        @csrf

                        <!-- Tarea -->
                        <div class="mb-3">
                            <label for="tarea_id" class="form-label fw-semibold">Tarea</label>
                            <select name="tarea_id" id="tarea_id" class="form-select @error('tarea_id') is-invalid @enderror" required>
                                <option value="">-- Seleccionar una tarea --</option>
                                @foreach($tareas as $tarea)
                                    <option value="{{ $tarea->id }}" {{ old('tarea_id') == $tarea->id ? 'selected' : '' }}>
                                        {{ $tarea->titulo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tarea_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="cliente" class="form-label fw-semibold">Nombre del Cliente</label>
                            <input type="text" name="cliente" id="cliente" class="form-control @error('cliente') is-invalid @enderror" value="{{ old('cliente') }}" required>
                            @error('cliente')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Costo Final -->
                        <div class="mb-3">
                            <label for="costo_final" class="form-label fw-semibold">Costo Final</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="costo_final" id="costo_final" class="form-control @error('costo_final') is-invalid @enderror" value="{{ old('costo_final') }}" required step="0.01" min="0">
                            </div>
                            @error('costo_final')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="estado" class="form-label fw-semibold">Estado</label>
                            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="completado" {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Notas del Cliente -->
                        <div class="mb-3">
                            <label for="notas_cliente" class="form-label fw-semibold">Notas del Cliente</label>
                            <textarea name="notas_cliente" id="notas_cliente" class="form-control @error('notas_cliente') is-invalid @enderror" rows="3">{{ old('notas_cliente') }}</textarea>
                            @error('notas_cliente')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('grupotrabajos.show', $grupo->id) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Asignar Tarea
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
