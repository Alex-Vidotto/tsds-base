@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modificar vehiculo</div>
                <div class="card-body">
                   

                <form action="{{ route('users.update', Auth::user()) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="name" class="mb-3">Nombre</label>
                        <input class="form-control" type="text" name="matricula" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="mb-3">Email</label>
                        <input class="form-control" type="text" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" value="{{ Auth::user()->passeword }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" value="{{ Auth::user()->passeword }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select name="rol" class="form-select" required>
                            <option value="">-- Selecciona un rol --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('rol') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                
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