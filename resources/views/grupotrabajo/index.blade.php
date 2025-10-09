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
        <a href="{{ route('grupotrabajo.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Cuadrilla
        </a>
    </div>

    <!-- Filtros -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('grupotrabajo.index') }}" class="row g-3 align-items-center">
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

@endsection
