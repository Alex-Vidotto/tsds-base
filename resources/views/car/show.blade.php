@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Detalles del Vehículo</span>
                </div>
                
                <div class="card-body">
                    <!-- Información Básica -->
                    <div class="row mb-4">
                        <div class="col-md-4 text-center mb-3">
                            @if($car->foto)
                                <img src="{{ asset('storage/' . $car->foto) }}" 
                                     alt="Foto del vehículo {{ $car->carModel->name ?? 'N/A' }}" 
                                     class="img-thumbnail rounded"
                                     style="width: 200px; height: 150px; object-fit: cover;">
                            @else
                                <img 
                                     alt="Sin imagen" 
                                     class="img-thumbnail rounded"
                                     style="width: 200px; height: 150px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">{{ $car->carModel?->nombre ?? '—' }}</h4>
                            <p class="text-muted mb-1">
                                <i class="fas fa-id-card me-2"></i>Matrícula: {{ $car->matricula }}
                            </p>
                            <p class="mb-1">
                                <span class="badge bg-{{ $car->estado === 'Disponible' ? 'success' : 'warning' }}">
                                    <i class="fas fa-{{ $car->estado === 'Disponible' ? 'check-circle' : 'exclamation-triangle' }} me-1"></i>
                                    {{ $car->estado }}
                                </span>
                            </p>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-calendar me-1"></i>
                                Registrado: {{ $car->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    <!-- Información Detallada -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-car me-2"></i>Información del Vehículo</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="text-muted">ID:</td>
                                            <td><strong>#{{ $car->id }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Modelo:</td>
                                            <td>
                                                @if($car->carModel)
                                                    <strong>{{ $car->carModel->name }}</strong><br>
                                                    <small class="text-muted">{{ $car->carModel->brand ?? 'Marca no definida' }}</small>
                                                @else
                                                    <span class="text-muted">No asignado</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Matrícula:</td>
                                            <td><strong>{{ $car->matricula }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Estado:</td>
                                            <td>
                                                <span class="badge bg-{{ $car->estado === 'Disponible' ? 'success' : 'warning' }}">
                                                    {{ $car->estado }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Foto del vehículo:</td>
                                            <td>
                                                @if($car->foto)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i> Subida
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-times me-1"></i> No subida
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Última actualización:</td>
                                            <td>{{ $car->updated_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detalles Técnicos</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="text-muted">Motor:</td>
                                            <td>{{ $car->fichaTecnica->motor ?? 'No especificado' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Combustible:</td>
                                            <td>{{ $car->fichaTecnica->combustible ?? 'No especificado' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Transmisión:</td>
                                            <td>{{ $car->fichaTecnica->transmision ?? 'No especificada' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Color:</td>
                                            <td>{{ $car->fichaTecnica->color ?? 'No especificado' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Año:</td>
                                            <td>{{ $car->fichaTecnica->anio ?? 'No especificado' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-list me-1"></i> Ver Todos los Vehículos
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Editar Vehículo
                            </a>
                            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" 
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este vehículo?')">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .badge {
        font-size: 0.75em;
    }
    .table-sm td {
        padding: 0.3rem 0;
    }
    .img-thumbnail {
        border: 3px solid #dee2e6;
    }
    .rounded {
        border-radius: 0.375rem !important;
    }
</style>
@endsection