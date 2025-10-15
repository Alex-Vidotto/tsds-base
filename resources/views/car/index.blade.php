@extends('layouts.admin')

@section('content')
    <div class="mb-3" style="text-align: right;">
        <a href="{{ route('cars.create') }}" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i> Nuevo Vehículo
        </a>
    </div>

    
    
            <div class="table-responsive">
                @include('car.busqueda')
                <table class="table table-striped" id="tablaDetalle">
                    <thead>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Matrícula</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Foto</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cars as $car)
                        <tr>
                            <!--<td>{{ $car->id }}</td>-->
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
                            <td>{{ $car->created_at->format('d/m/Y') }}</td>
                            <td>
                                        <a href = "{{ route('cars.edit', $car->id) }}" class = "btn btn-outline-warning">Editar</a>
                                            <form action = "{{ route('cars.destroy' , $car->id) }}" method = "POST" style = "display:inline-block;">
                                                @csrf
                                                @method ('DELETE')
                                                <button type = "submit" class = "btn btn-outline-danger text-nowrap" onclick = "return confirm('¿Estas seguro de eliminar el vehiculo?')">
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

            </div>
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