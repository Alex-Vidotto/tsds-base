@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Vehículos</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('cars.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus fa-xs me-1"></i> Nuevo Vehículo
            </a>
            <a href="{{ route('carservicedates.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-wrench fa-xs me-1"></i> Mantenimiento
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-2">
            <h6 class="mb-0 fw-semibold">Vehículos Registrados</h6>
        </div>
        <div class="card-body pt-3 pb-0">
            @include('car.busqueda')

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show p-2 mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close p-1" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive mt-3">
                <table class="table table-hover table-sm align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col" class="text-center">Foto</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Registro</th>
                            <th scope="col" class="text-end pe-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cars as $car)
                        <tr>
                            <td><strong>{{ $car->matricula }}</strong></td>
                            <td>{{ $car->carModel?->carBrand?->nombre ?? '—' }}</td>
                            <td>{{ $car->carModel?->nombre ?? '—' }}</td>
                            <td class="text-center">
                                @if($car->foto)
                                    <img src="{{ asset('images/vehiculos/' . $car->foto) }}"
                                         alt="Foto del vehículo"
                                         class="rounded"
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @php $estado = strtolower($car->estado ?? ''); @endphp
                                @if($estado === 'activo')
                                    <span class="badge bg-success">Activo</span>
                                @elseif($estado === 'inactivo')
                                    <span class="badge bg-secondary">Inactivo</span>
                                @else
                                    <span class="text-muted">{{ $car->estado ?? '—' }}</span>
                                @endif
                            </td>
                            <td>{{ $car->created_at?->format('d/m/Y') ?? '—' }}</td>
                            <td class="text-end pe-3">
                                <a href="{{ route('cars.edit', $car->id) }}" 
                                   class="btn btn-warning btn-sm" 
                                   title="Editar">
                                    <i class="fas fa-edit fa-xs"></i>
                                </a>
                                <form action="{{ route('cars.destroy', $car->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este vehículo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-car fa-sm me-1"></i> No hay vehículos registrados
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