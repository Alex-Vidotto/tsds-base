@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Detalles del Usuario</span>
                </div>
                
                <div class="card-body">
                    <!-- Información Básica -->
                    <div class="row mb-4">
                        <div class="col-md-4 text-center mb-3">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 100px; height: 100px;">
                                <span class="text-white fw-bold fs-4">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">{{ $user->name }}</h4>
                            <p class="text-muted mb-1">
                                <i class="fas fa-envelope me-2"></i>{{ $user->email }}
                            </p>
                            <p class="mb-1">
                                <span class="badge bg-{{ $user->email_verified_at ? 'success' : 'warning' }}">
                                    <i class="fas fa-{{ $user->email_verified_at ? 'check-circle' : 'clock' }} me-1"></i>
                                    {{ $user->email_verified_at ? 'Email Verificado' : 'Email No Verificado' }}
                                </span>
                            </p>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-calendar me-1"></i>
                                Registrado: {{ $user->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    <!-- Información Detallada -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-id-card me-2"></i>Información de Cuenta</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="text-muted">ID:</td>
                                            <td><strong>#{{ $user->id }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Rol:</td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ $user->getRoleNames()->first() ?? 'Sin rol asignado' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Estado:</td>
                                            <td>
                                                <span class="badge bg-{{ $user->deleted_at ? 'danger' : 'success' }}">
                                                    {{ $user->deleted_at ? 'Inactivo' : 'Activo' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Última actualización:</td>
                                            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Estadísticas</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="text-muted">Miembro desde:</td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Días como miembro:</td>
                                            <td>{{ $user->created_at->diffInDays() }} días</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Última actividad:</td>
                                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional (si tienes más campos) -->
                    @if($user->profile) {{-- Si tienes un perfil relacionado --}}
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-user me-2"></i>Información Adicional</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Teléfono:</strong> {{ $user->profile->phone ?? 'No especificado' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Dirección:</strong> {{ $user->profile->address ?? 'No especificada' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Acciones -->
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-list me-1"></i> Ver Todos los Usuarios
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Editar Usuario
                            </a>
                            @if(!$user->deleted_at)
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" 
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                                        <i class="fas fa-trash me-1"></i> Eliminar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .badge {
        font-size: 0.75em;
    }
    .table-sm td {
        padding: 0.3rem 0;
    }
</style>
@endsection