@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modificar Usuario: {{ $user->name }}</div>
                <div class="card-body">
                   
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Campo para la foto de perfil -->
                        <div class="form-group mb-3">
                            <label for="foto" class="form-label">Foto de Perfil</label>
                            
                            <!-- Mostrar foto actual si existe -->
                            @if($user->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $user->foto) }}" 
                                         alt="Foto de perfil" 
                                         class="img-thumbnail" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                    <br>
                                    <small>Foto actual</small>
                                </div>
                            @endif
                            
                            <!-- Contenedor para la previsualización -->
                            <div id="preview-container" class="mb-2" style="display: none;">
                                <img id="preview-image" src="" alt="Vista previa" 
                                     class="img-thumbnail" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                                <br>
                                <small>Vista previa de la nueva imagen</small>
                            </div>
                            
                            <input type="file" name="foto" id="foto" class="form-control" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif">
                            <small class="form-text text-muted">
                                Formatos permitidos: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input class="form-control" type="text" name="name" id="name" 
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" id="email" 
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small class="form-text text-muted">Dejar en blanco si no quieres cambiar la contraseña</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select name="rol" id="rol" class="form-select" required>
                                <option value="">-- Selecciona un rol --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" 
                                        {{ old('rol', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-success">
                            Guardar Cambios
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#foto').change(function() {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
                $('#preview-container').show();
            }
            
            reader.readAsDataURL(file);
        } else {
            $('#preview-container').hide();
            $('#preview-image').attr('src', '');
        }
    });
});
</script>

@endsection