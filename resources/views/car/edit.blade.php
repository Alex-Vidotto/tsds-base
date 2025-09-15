
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modificar vehiculo</div>
                <div class="card-body">
                   

                <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body mb-3">
                        <label for="matricula" class="mb-3">Matrícula</label>
                        <input class="form-control" type="text" name="matricula" value="{{ $car->matricula }}" required>
                    </div>
                
                    <div class="card-body mb-3">
                        <label for="car_model_id" class="form-label"><i class="fas fa-car me-1 text-primary"></i>Modelo del Auto</label>
                        <select class="form-select" id="car_model_id" name="car_model_id" required>
                            <option value="">Seleccione un modelo</option>
                            @foreach($carModels as $model)
                                <option value="{{ $model->id }}" 
                                    {{ $car->car_model_id == $model->id ? 'selected' : '' }}>
                                    {{ $model->nombre }} {{-- Asumiendo que tiene campo 'nombre' --}}
                                    @if($model->carBrand) - {{ $model->carBrand->nombre }} @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-body mb-3">
                        <label for="foto" class="form-label"><i class="fas fa-camera me-1 text-primary"></i>Foto del Vehículo</label>
                        <div class="input-group">
                            <label for="foto" class="btn btn-outline-primary mb-0">
                                <i class="fas fa-upload me-1"></i> Seleccionar archivo
                            </label>
                            <input type="file" name="foto" id="foto" class="d-none" accept="image/*">
                            <span class="form-text ms-2">No se ha seleccionado ningún archivo</span>
                        </div>
                        @if($car->foto)
                            <div class="mt-2">
                                <img src="{{ asset('images/vehiculos/' . $car->foto) }}" alt="Foto actual" class="img-thumbnail" width="150">
                                <p class="small text-muted">Foto actual</p>
                            </div>
                        @endif
                    </div>
                
                    <button type="submit" class="btn btn-outline-success">
                        Guardar
                    </button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection