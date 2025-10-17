<div class = "container mt-3">
    <form action = "{{ route ('cars.index')}}" method = "GET" autocomplete = "on" role = "search">
        <div class = "row">
            <div class = "col-lg-3 col-md-4 col-sm-6 mb-3">
                <label for = "car_model_id" > Modelo</label>
                <select name = "car_model_id" id = "car_model_id" class = "form-control">
                    <option value = "">-- Todos los modelos --</option>
                    @foreach ($opciones as $option)
                        <option value="{{ $option['id'] }}" {{ request('car_model_id') == $option["id"] ? 'selected' : '' }}>
                            {{ $option['text'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class = "col-lg-3 col-md-4 col-sm-6 mb-3">
                <label for = "desde"> Fecha Desde </label>
                <input
                    type = "date"
                    name = "desde"
                    id = "desde"
                    class = "form-control"
                    value = "{{ request('desde') }}">
            </div>
            <div class = "col-lg-3 col-md-4 col-sm-6 mb-3">
                <label for = "hasta"> Fecha Hasta </label>
                <input
                    type = "date"
                    name = "hasta"
                    id = "hasta"
                    class = "form-control"
                    value = "{{ request('hasta') }}">   
            </div>
            <div class = "col-lg-3 col-md-12 col-sm-12 mb-3 d-flex align-items-end">
                <button type = "submit" class = "btn btn-primary mr-2">
                    <i class = "fa fa-filter"></i> Filtrar
                </button>  
                        
                <a href="{{ route('cars.exportPdf', [], false)
                    .  '?desde=' . request('desde')
                    .  '&hasta=' . request('hasta')
                    .  '&car_brand_id=' . request('car_brand_id')}}"
                    class="btn btn-danger" target="_blank">
                    <i class="fas fa-file-pdf"></i>  PDF
                </a>

                <a href = "{{ route ('cars.index') }}" class = "btn btn-secondary">
                    <i class = "fas fa-eraser"></i> Limpiar
                </a>
            </div>
        </div>
    </form>
</div>
