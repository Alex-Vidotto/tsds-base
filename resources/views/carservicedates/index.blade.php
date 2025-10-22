@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>
            <i class="fas fa-clipboard-list mr-2 text-primary"></i> Mantenimiento de Vehículos
        </h3>
        <div class="d-flex">
            <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary shadow-sm mr-2">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
            <a href="{{ route('carservicedates.create') }}" class="btn btn-success shadow-sm">
                <i class="fas fa-plus-circle mr-1"></i> Nuevo Mantenimiento
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-car mr-2 text-primary"></i> Vehículos en mantenimiento
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Patente</th>
                            <th>Servicio</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carservicedates as $carservicedate)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($carservicedate->fecha_mantenimiento)->format('d/m/Y') }}</td>
                                <td>{{ $carservicedate->car->matricula }}</td>
                                <td>{{ $carservicedate->carservice->Tipo_servicio }}</td>
                                <td>
                                    @php
                                        $fechaHoy = \Carbon\Carbon::today();
                                        $fechaMantenimiento = \Carbon\Carbon::parse($carservicedate->fecha_mantenimiento);
                                    @endphp
                                    @if ($fechaMantenimiento->isToday())
                                        <span><i class="fas fa-tools mr-1"></i> En mantenimiento</span>
                                    @elseif ($fechaMantenimiento->isFuture())
                                        <span><i class="fas fa-calendar-check mr-1"></i> Programado</span>
                                    @else
                                        <span><i class="fas fa-check-double mr-1"></i> Finalizado</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('carservicedates.', $carservicedate->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle mr-2"></i> No hay registros de mantenimiento
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection