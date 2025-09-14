@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vehiculo') }}</div>

                <div class="card-body">
                    <from action="{{ route('cars.store') }}" method="POST" enctype="multipart/from-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="matricula" class="form-lable">
                                {{ __('Matricula') }}
                            </label>
                            <div class="col-md-6">
                                <input id="matricula" type="text"
                                class="from-control @error('matricula') is-invalid @enderror"
                                name="matricula" value="{{ old('matricula') }}" required autocomplete="off" autofocus
                                placeholder="Ejemplo: 123AAB">

                                @error('matricula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="car_model_id" class="form-label"><i class="fas fa-car me-1 text-primary"></i>Modelo del Vehiculo</label>
                            <select class="form-select" id="car_model_id" name="car_model_id" required>
                                <option value="">Seleccione un modelo</option>
                                @foreach($opciones as $option)
                                    <option value="{{ $option['id'] }}">
                                        {{ $option['text'] }}
                                    </option>
                                @endforeach                            
                            </select>
                        </div>


                        <!--<div class="mb-3">
                            <label for="foto" class="form-label">Foto del Vehículo</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>-->

                        <div class="mb-4">
    <label class="form-label fw-semibold">
        <i class="fas fa-camera me-1 text-primary"></i>Foto del Vehículo
    </label>
    
    <div class="border rounded-3 p-4 text-center bg-light">
        <i class="fas fa-cloud-upload-alt fs-1 text-muted mb-3"></i>
        <p class="text-muted mb-3">Arrastra o selecciona una imagen</p>
        
        <input type="file" 
               class="form-control d-none" 
               id="foto" 
               name="foto" 
               accept="image/*">
        
        <label for="foto" class="btn btn-primary">
            <i class="fas fa-upload me-2"></i>Seleccionar Imagen
        </label>
        
        <div class="mt-2 small text-muted">
            Formatos: JPG, PNG, GIF - Máx. 2MB
        </div>
    </div>
</div>


                        <button type="submit" class="btn btn-primary">Crear Vehículo</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection