<div class="container mt-3">
    <form action="{{ route('cars.index') }}" method="GET" autocomplete="on" role="search">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <label for="car_model_id"> Modelo</label>
                <select name="car_model_id" id="car_model_id" class="form-control">
                    <option value="">-- Todos los modelos --</option>
                    @foreach ($opciones as $option)
                        <option value="{{ $option['id'] }}" {{ request('car_model_id') == $option["id"] ? 'selected' : '' }}>
                            {{ $option['text'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <label for="car_service_id">Tipo de Mantenimiento</label>
                <select name="car_service_id" id="car_service_id" class="form-control">
                    <option value="">-- Todos los tipos --</option>
                    @foreach ($tiposServicio as $servicio)
                        <option value="{{ $servicio->id }}" {{ request('car_service_id') == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->Tipo_servicio }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <label for="desde"> Fecha Desde </label>
                <input
                    type="date"
                    name="desde"
                    id="desde"
                    class="form-control"
                    value="{{ request('desde') }}">
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <label for="hasta"> Fecha Hasta </label>
                <input
                    type="date"
                    name="hasta"
                    id="hasta"
                    class="form-control"
                    value="{{ request('hasta') }}">   
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-filter fa-xs"></i> Filtrar
                </button>  
                        
                <a href="{{ route('cars.exportPdf', [], false)
                    . '?desde=' . request('desde')
                    . '&hasta=' . request('hasta')
                    . '&car_model_id=' . request('car_model_id')
                    . '&car_service_id=' . request('car_service_id')}}"
                    class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-file-pdf fa-xs"></i> PDF
                </a>

                <a href="{{ route('cars.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-eraser fa-xs"></i> Limpiar
                </a>
            </div>
        </div>
    </form>
</div>