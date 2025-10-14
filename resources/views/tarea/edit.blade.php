
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarea</div>
                <div class="card-body">
                   
                <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input class="form-control" type="text" name="titulo" value="{{ $tarea->titulo }}" required>
                        <button type="submit" class="btn btn-outline-success">
                            Guardar
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


