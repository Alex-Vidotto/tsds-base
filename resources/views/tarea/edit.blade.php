@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-4 text-dark text-shadow-inset">
        Editar Tarea
    </h1>
    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="titulo" value="{{ $tarea->titulo }}" required>
        <button type="submit" class="btn btn-outline-success">
            Guardar
        </button>
    </form>
</div>
@endsection