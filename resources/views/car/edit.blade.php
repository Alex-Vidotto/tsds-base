
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarea</div>
                <div class="card-body">
                   
                <!--<form action="{{ route('cars.update', $car->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input class="form-control" type="text" name="matricula" value="{{ $car->matricula }}" required>
                        <button type="submit" class="btn btn-outline-success">
                            Guardar
                        </button>
                </form>-->

                <form action="{{ route('cars.update', $car->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input class="form-control" type="text" name="matricula" value="{{ $car->matricula }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="car_model_id" class="form-label">Modelo del Auto</label>
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