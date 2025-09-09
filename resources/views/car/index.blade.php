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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            <td>{{ $car->id }}</td>
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
                                        <a href = "{{ route('cars.edit', $car->id) }}" class = "btn btn-warning btn-sm">Editar</a>
                                            <form action = "{{ route('cars.destroy' , $car->id) }}" method = "POST" style = "display:inline-block;">
                                                @csrf
                                                @method ('DELETE')
                                                <button type = "submit" class = "btn btn-danger btn-sm" onclick = "return confirm('¿Estas seguro de eliminar esta tarea')">
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

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-3">
                {{ $cars->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection