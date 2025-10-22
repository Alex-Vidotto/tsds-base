@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-car mr-2 text-primary"></i> {{ __('Registrar Vehículo') }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Matrícula -->
                        <div class="form-group mb-4">
                            <label for="matricula" class="form-label font-weight-bold">
                                {{ __('Matrícula') }}
                            </label>
                            <input
                                id="matricula"
                                type="text"
                                class="form-control{{ $errors->has('matricula') ? ' is-invalid' : '' }}"
                                name="matricula"
                                value="{{ old('matricula') }}"
                                required
                                autocomplete="off"
                                autofocus
                                placeholder="Ejemplo: ABC123"
                            >
                            @if ($errors->has('matricula'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('matricula') }}
                                </div>
                            @endif
                        </div>

                        <!-- Modelo del Vehículo -->
                        <div class="form-group mb-4">
                            <label for="car_model_id" class="form-label font-weight-bold">
                                <i class="fas fa-car mr-1 text-primary"></i> Modelo del Vehículo
                            </label>
                            <select
                                class="form-control{{ $errors->has('car_model_id') ? ' is-invalid' : '' }}"
                                id="car_model_id"
                                name="car_model_id"
                                required
                            >
                                <option value="">{{ __('Seleccione un modelo') }}</option>
                                @foreach($opciones as $option)
                                    <option value="{{ $option['id'] }}" {{ old('car_model_id') == $option['id'] ? 'selected' : '' }}>
                                        {{ $option['text'] }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('car_model_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('car_model_id') }}
                                </div>
                            @endif
                        </div>

                        <!-- Foto del Vehículo -->
                        <div class="form-group mb-4">
                            <label for="foto" class="form-label font-weight-bold">
                                <i class="fas fa-camera mr-1 text-primary"></i> Foto del Vehículo
                            </label>
                            <input
                                type="file"
                                name="foto"
                                id="foto"
                                class="form-control-file{{ $errors->has('foto') ? ' is-invalid' : '' }}"
                                accept="image/*"
                            >
                            @if ($errors->has('foto'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('foto') }}
                                </div>
                            @endif
                        </div>

                        <!-- Ficha Técnica -->
                        <h5 class="mb-3 mt-4 pb-2 border-bottom">
                            <i class="fas fa-file-alt mr-2 text-secondary"></i> Ficha Técnica
                        </h5>

                        <div class="row">
                            <!-- Motor -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Motor</label>
                                    <input
                                        type="text"
                                        name="motor"
                                        class="form-control{{ $errors->has('motor') ? ' is-invalid' : '' }}"
                                        value="{{ old('motor') }}"
                                        placeholder="Ej: 2.0L"
                                    >
                                    @if ($errors->has('motor'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('motor') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Combustible -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Combustible</label>
                                    <input
                                        type="text"
                                        name="combustible"
                                        class="form-control{{ $errors->has('combustible') ? ' is-invalid' : '' }}"
                                        value="{{ old('combustible') }}"
                                        placeholder="Ej: Gasolina"
                                    >
                                    @if ($errors->has('combustible'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('combustible') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Transmisión -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Transmisión</label>
                                    <input
                                        type="text"
                                        name="transmision"
                                        class="form-control{{ $errors->has('transmision') ? ' is-invalid' : '' }}"
                                        value="{{ old('transmision') }}"
                                        placeholder="Ej: Automática"
                                    >
                                    @if ($errors->has('transmision'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('transmision') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Botón de envío -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-plus-circle mr-1"></i> Crear Vehículo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection