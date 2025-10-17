@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text">
            <i class="fas fa-clipboard-list me-2 text-primary"></i> Mantenimiento de Vehículos
        </h3>
        <a href="{{ route('carservicedates.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nuevo Mantenimiento
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-start border-success border-3">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body-tertiary">
            <h5 class="mb-0 text"><i class="fas fa-car me-2 text-primary"></i> Vehículos en mantenimiento</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table">
                        <tr>
                            <th>Fecha</th>
                            <th>Patente</th>
                            <th>Servicio</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carservicedates as $carservicedate)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($carservicedate->fecha_mantenimiento)->format('d/m/Y') }}</td>
                            <td>{{ $carservicedate->car->matricula }}</td>
                            <td>{{ $carservicedate->carservice->Tipo_servicio }}</td>
                            <td>
                                @php
                                    $fechaHoy = \Carbon\Carbon::today();
                                    $fechaMantenimiento = \Carbon\Carbon::parse($carservicedate->fecha_mantenimiento);
                                @endphp
                                @if ($fechaMantenimiento->isToday())
                                    <span class="text"><i class="fas fa-tools me-1"></i> En mantenimiento</span>
                                @elseif ($fechaMantenimiento->isFuture())
                                    <span class="text"><i class="fas fa-calendar-check me-1"></i> Programado</span>
                                @else
                                    <span class="text"><i class="fas fa-check-double me-1"></i> Finalizado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('carservicedates.edit', $carservicedate->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit me-1"></i> Editar
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle me-2"></i> No hay vehículos registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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