@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mantenimiento') }}</div>

                <div class="card-body">
                    <form action="{{ route('carservicedates.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body mb-3">
                            <label for="fecha_mantenimiento" class="form-label"><i class="fas fa-calendar me-1 text-primary"></i>
                                {{ __('Fecha') }}
                            </label>
                            <div class="mb-3">
                                <input id="fecha_mantenimiento" type="date"
                                placeholder="Ejemplo: 12/12/2025">
                            </div>
                        </div>


                        <div class="card-body mb-3">
                            <label for="car_id" class="form-label"><i class="fas fa-car me-1 text-primary"></i>Patente</label>
                            <select class="form-select" id="car_id" name="car_id" required>
                                <option value="">Seleccionar patente</option>
                                @foreach($cars as $car)
                                
                                    <option value="{{ $car }}">
                                        {{ $car->matricula }}
                                    </option>
                                @endforeach                            
                            </select>
                        </div>



                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Confirmar mantenimiento</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection 
