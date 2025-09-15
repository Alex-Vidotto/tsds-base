@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vehiculo') }}</div>

                <div class="card-body">
                    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body mb-3">
                            <label for="matricula" class="form-label">
                                {{ __('Matricula') }}
                            </label>
                            <div class="mb-3">
                                <input id="matricula" type="text"
                                class="form-control @error('matricula') is-invalid @enderror"
                                name="matricula" value="{{ old('matricula') }}" required autocomplete="off" autofocus
                                placeholder="Ejemplo: 123AAB">

                                @error('matricula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="card-body mb-3">
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



                        <div class="card-body mb-3">
                            <label for="foto"><i class="fas fa-camera me-1 text-primary"></i>Foto del Vehículo</label>
                            <input type="file" name="foto" id="foto"
                                   class="form-control-file @error('foto') is-invalid @enderror" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Crear Vehículo</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection