
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Tareas') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Acordeón principal con "Lista de Tareas" -->
                    <div class="accordion mb-2" id="mainAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMain">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMain" aria-expanded="true" aria-controls="collapseMain">
                                    Tareas Guardadas
                                </button>
                            </h2>
                            <div id="collapseMain" class="accordion-collapse collapse show" aria-labelledby="headingMain" data-bs-parent="#mainAccordion">
                                <div class="accordion-body">
                                    @if($tareas->count())
                                        <ul class="list-group mb-3">
                                            @foreach($tareas as $tarea)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>{{ $tarea->titulo }}</span>
                                                    <span>
                                                        <a href="/tareas/{{ $tarea->id }}/edit" class="btn btn-outline-warning">Editar</a>
                                                        <form action="/tareas/{{ $tarea->id }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                                        </form>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="text-muted">No hay tareas registradas.</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario para crear nueva tarea -->
                    <form action="/tareas" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="text" name="titulo" placeholder="Nueva tarea" class="form-control" required>
                        <button type="submit" class="btn btn-outline-primary">Agregar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection