@extends('layouts.admin')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-tools me-2"></i> Programar mantenimiento</h5>
                </div>

                <div class="card-body bg-light">
                    @if ($errors->any())
                        <div class="alert alert-danger border-start border-danger border-3">
                            <strong><i class="fas fa-exclamation-triangle me-1"></i> Se encontraron errores:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('carservicedates.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Fecha de mantenimiento --}}
                        <div class="mb-4">
                            <label for="fecha_mantenimiento" class="form-label fw-bold text-primary">
                                <i class="fas fa-calendar-alt me-1"></i> Fecha de mantenimiento
                            </label>
                            <input
                                id="fecha_mantenimiento"
                                type="date"
                                name="fecha_mantenimiento"
                                class="form-control @error('fecha_mantenimiento') is-invalid @enderror"
                                value="{{ old('fecha_mantenimiento') }}"
                            >
                            @error('fecha_mantenimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Vehículo --}}
                        <div class="mb-4">
                            <label for="car_id" class="form-label fw-bold text-primary">
                                <i class="fas fa-car me-1"></i> Vehículo
                            </label>
                            <select class="form-control @error('car_id') is-invalid @enderror" id="car_id" name="car_id">
                                <option value="">Seleccionar patente</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                        {{ $car->matricula }}
                                    </option>
                                @endforeach
                            </select>
                            @error('car_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tipo de servicio --}}
                        <div class="mb-4">
                            <label for="car_service_id" class="form-label fw-bold text-primary">
                                <i class="fas fa-wrench me-1"></i> Tipo de servicio
                            </label>
                            <select class="select2-prueba form-control @error('car_service_id') is-invalid @enderror" id="car_service_id" name="car_service_id">
                                <option value="">Seleccione un servicio</option>
                                @foreach($carservices as $carservice)
                                    <option value="{{ $carservice->id }}" {{ old('car_service_id') == $carservice->id ? 'selected' : '' }}>
                                        {{ $carservice->Tipo_servicio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('car_service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end d-flex justify-content-end gap-2">
                            <button href="{{ route('carservicedates.index') }}" class="btn btn-warning text">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </button>                        
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-check-circle me-1"></i> Confirmar mantenimiento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>
        // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2-prueba').select2();
});

    </script>
@endpush