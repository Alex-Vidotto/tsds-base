@extends('layouts.app')

@section('content')
<div class="container">
    <h1
        class="text-left text-primary my-4" style="font-weight: bold; font-size: 2.5rem;">
        Editar Tarea
    </h1>
    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="titulo" value="{{ $tarea->titulo }}" required>
        <button type="submit" class="btn btn-outline-success">
            Guardar
    </form>
</div>
@endsection