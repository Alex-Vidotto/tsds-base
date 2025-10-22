
@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-edit text-primary me-2"></i>Modificar Vehículo
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Matrícula -->
                        <div class="form-group mb-4">
                            <label for="matricula" class="form-label font-weight-bold">Matrícula</label>
                            <input 
                                type="text" 
                                class="form-control @error('matricula') is-invalid @enderror" 
                                id="matricula" 
                                name="matricula" 
                                value="{{ old('matricula', $car->matricula) }}" 
                                required
                            >
                            @error('matricula')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Modelo del Auto -->
                        <div class="form-group mb-4">
                            <label for="car_model_id" class="form-label font-weight-bold">
                                <i class="fas fa-car me-1 text-primary"></i>Modelo del Vehículo
                            </label>
                            <select 
                                class="form-control @error('car_model_id') is-invalid @enderror" 
                                id="car_model_id" 
                                name="car_model_id" 
                                required
                            >
                                <option value="">— Seleccione un modelo —</option>
                                @foreach($carModels as $model)
                                    <option value="{{ $model->id }}" 
                                        {{ old('car_model_id', $car->car_model_id) == $model->id ? 'selected' : '' }}>
                                        {{ $model->nombre }}
                                        @if($model->carBrand)
                                            — {{ $model->carBrand->nombre }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('car_model_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto del Vehículo -->
                        <div class="form-group mb-4">
                            <label for="foto" class="form-label font-weight-bold">
                                <i class="fas fa-camera me-1 text-primary"></i>Foto del Vehículo
                            </label>
                            <input 
                                type="file" 
                                class="form-control-file @error('foto') is-invalid @enderror" 
                                id="foto" 
                                name="foto" 
                                accept="image/*"
                            >
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <!-- Mostrar foto actual si existe -->
                            @if($car->foto)
                                <div class="mt-3">
                                    <small class="text-muted d-block mb-1">Foto actual:</small>
                                    <img 
                                        src="{{ asset('images/vehiculos/' . $car->foto) }}" 
                                        alt="Foto del vehículo" 
                                        class="img-thumbnail rounded"
                                        style="max-width: 180px; height: auto;"
                                    >
                                </div>
                            @endif
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('cars.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>Actualizar Vehículo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection