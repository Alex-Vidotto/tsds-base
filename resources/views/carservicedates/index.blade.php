@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="bm-3">Mantenimiento</h1>
    <div class="mb-3" style="text-align: right;">
        <a href="{{ route('carservicedates.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Mantenimiento
        </a>
    </div>

        <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Vehículos En Mantenimiento</h5>
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
                            <th>Fecha del Mantenimiento</th>
                            <th>Matricula del vehiculo</th>
                            <th>Tipo de Servicio</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carservicedates as $carservicedate)
                        <tr>
                            <td>
                                {{ $carservicedate->fecha_mantenimiento }}
                            </td>
                            <td>
                                {{ $carservicedate->car->matricula }}
                            </td>
                            <td>
                                {{ $carservicedate->carservice->Tipo_servicio }}
                            </td>
                            <td>{{ $carservicedate->created_at->format('d/m/Y') }}</td>
                            <td>
                                        <a href = "{{ route('carservicedates.edit', $carservicedate->id) }}" class = "btn btn-warning btn-sm">Editar</a>
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