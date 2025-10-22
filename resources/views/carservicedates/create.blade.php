@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-tools mr-2"></i> Programar mantenimiento
                    </h5>
                </div>

                <div class="card-body bg-light">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle mr-1"></i> Se encontraron errores:</strong>
                            <ul class="mb-0 mt-2 pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('carservicedates.store') }}" method="POST">
                        @csrf

                        {{-- Fecha de mantenimiento --}}
                        <div class="form-group mb-4">
                            <label for="fecha_mantenimiento" class="font-weight-bold text-primary">
                                <i class="fas fa-calendar-alt mr-1"></i> Fecha de mantenimiento
                            </label>
                            <input
                                id="fecha_mantenimiento"
                                type="date"
                                name="fecha_mantenimiento"
                                class="form-control{{ $errors->has('fecha_mantenimiento') ? ' is-invalid' : '' }}"
                                value="{{ old('fecha_mantenimiento') }}"
                            >
                            @if ($errors->has('fecha_mantenimiento'))
                                <div class="invalid-feedback">{{ $errors->first('fecha_mantenimiento') }}</div>
                            @endif
                        </div>

                        {{-- Vehículo --}}
                        <div class="form-group mb-4">
                            <label for="car_id" class="font-weight-bold text-primary">
                                <i class="fas fa-car mr-1"></i> Vehículo
                            </label>
                            <select class="form-control{{ $errors->has('car_id') ? ' is-invalid' : '' }}" id="car_id" name="car_id">
                                <option value="">Seleccionar patente</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                        {{ $car->matricula }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('car_id'))
                                <div class="invalid-feedback">{{ $errors->first('car_id') }}</div>
                            @endif
                        </div>

                        {{-- Tipo de servicio --}}
                        <div class="form-group mb-4">
                            <label for="car_service_id" class="font-weight-bold text-primary">
                                <i class="fas fa-wrench mr-1"></i> Tipo de servicio
                            </label>
                            <select class="form-control{{ $errors->has('car_service_id') ? ' is-invalid' : '' }}" id="car_service_id" name="car_service_id">
                                <option value="">Seleccione un servicio</option>
                                @foreach($carservices as $carservice)
                                    <option value="{{ $carservice->id }}" {{ old('car_service_id') == $carservice->id ? 'selected' : '' }}>
                                        {{ $carservice->Tipo_servicio }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('car_service_id'))
                                <div class="invalid-feedback">{{ $errors->first('car_service_id') }}</div>
                            @endif
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('carservicedates.index') }}" class="btn btn-warning mr-2">
                                <i class="fas fa-arrow-left mr-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-check-circle mr-1"></i> Confirmar mantenimiento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection