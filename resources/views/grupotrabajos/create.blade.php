@extends('layouts.admin')
@section('content')

<div class="container">
    <h1 class="mb-4">Crear Grupo de Trabajo</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Errores:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('grupotrabajos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del grupo *</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="car_id" class="form-label">Auto asignado</label>
            <select name="car_id" id="car_id" class="form-select">
                <option value="">-- Sin auto --</option>
                @foreach($autos as $auto)
                    <option value="{{ $auto->id }}" {{ old('car_id') == $auto->id ? 'selected' : '' }}>
                        {{ $auto->matricula }} 
                        @if($auto->carModel)
                            - {{ $auto->carModel->nombre ?? 'Modelo no disponible' }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="empleados" class="form-label">Asignar empleados</label>
            <select name="empleados[]" id="empleados" class="form-select" multiple size="5">
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" {{ in_array($empleado->id, old('empleados', [])) ? 'selected' : '' }}>
                        {{ $empleado->name }} ({{ $empleado->email }})
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Mantén presionado Ctrl (Windows) o Cmd (Mac) para seleccionar múltiples empleados</small>
        </div>

        @if($empleados->isEmpty())
            <div class="alert alert-warning">
                No hay empleados disponibles para asignar. Todos los empleados ya están asignados a otros grupos.
            </div>
        @endif

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Crear grupo</button>
            <a href="{{ route('grupotrabajos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
