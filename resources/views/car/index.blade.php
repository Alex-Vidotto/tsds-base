@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Vehículos</h1>

    <div class="mb-3" style="text-align: right;">
        <a href="{{ route('cars.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Vehículo
        </a>
    </div>

    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Vehículos Registrados</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped" id="tablaDetalle">
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Foto</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cars as $car)
                        <tr>
                            <td>
                                <strong>{{ $car->matricula }}</strong>
                            </td>
                            <td>
                                {{ $car->carModel->carBrand->nombre }}
                            </td>
                            <td>
                                {{ $car->carModel->nombre }}
                            </td>
                            <td>
                                @if($car->foto)
                                    <img src="{{ asset('images/vehiculos/' . $car->foto) }}" 
                                         alt="Foto" width="50" height="50" class="rounded">
                                @else
                                    <span class="text-muted">Sin foto</span>
                                @endif
                            </td>
                            <td>{{ $car->estado}}</th>
                            <td>{{ $car->created_at->format('d/m/Y') }}</td>
                            <td>
                                        <a href = "{{ route('cars.edit', $car->id) }}" class = "btn btn-warning btn-sm">Editar</a>
                                            <form action = "{{ route('cars.destroy' , $car->id) }}" method = "POST" style = "display:inline-block;">
                                                @csrf
                                                @method ('DELETE')
                                                <button type = "submit" class = "btn btn-danger btn-sm" onclick = "return confirm('¿Estas seguro de eliminar el vehiculo?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </a>
                                    </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No hay vehículos registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>

<div class="form-group col-md-3 d-flex align-items-end">
    <div class="btn-group" role="group" aria-label="Acciones">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> Buscar
        </button>

        
        <a href="{{ route('cars.pdf', [], false)
            .  '?desde=' . request('desde')
            .  '&hasta=' . request('hasta')
            .  '&car_brand_id=' . request('car_brand_id')}}"
            class="btn btn-danger" target="_blank">
            <i class="fas fa-file-pdf"></i>  PDF
        </a>
        
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">
            <i class="fas fa-eraser"></i> Limpiar
        </a>

    </div>
</div>
    <div class="mb-3" style="text-align: right;">
        <a href="{{ route('carservicedates.index') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Mantenimiento Vehículo
        </a>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            console.log("Jquery funcionando");
        });

        $(document).ready(function(){
            $('#tablaDetalle').DataTable({
                "language": {
                    "info": "_TOTAL_ registros",
                    "search": "Buscar",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior",
                    },
                    "lengthMenu": 'Mostrar <select class="form-select form-select-sm ms-1 me-1">'+
                                  '<option value="5">5</option>'+
                                  '<option value="10">10</option>'+
                                  '<option value="20">20</option>'+
                                  '<option value="50">50</option>'+
                                  '<option value="-1">Todos</option>'+
                                  '</select> registros',
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "emptyTable": "No hay datos",
                    "zeroRecords": "No hay coincidencias",
                    "infoEmpty": "",
                    "infoFiltered": ""
                }
            })
        })

    </script>
@endpush