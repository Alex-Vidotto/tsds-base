
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<h1>Lista de Tareas</h1>

<form action="/tareas" method="POST">
    @csrf
    <input type="text" name="titulo" placeholder="Nueva tarea">
    <button type="submit">Agregar</button>
</form>

<ul>
@foreach($tareas as $tarea)
    <li>
        {{ $tarea->titulo }} -
        <a href="/tareas/{{ $tarea->id }}/edit">Editar</a>       
        <form action="/tareas/{{ $tarea->id }}" method="POST"
style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </li>
@endforeach
</ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection