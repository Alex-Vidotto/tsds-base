@extends('layouts.admin')

@section('content')

<div class="container-fluid">
  <!-- Título -->
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="text-center">Panel de Empleado</h2>
      <p class="text-center text-muted">Resumen general de gestión</p>
    </div>
  </div>

  <!-- Fila de cajas -->
  <div class="row">
    <!-- Grupos de trabajos -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $grupoTrabajoCount }}</h3>
          <p>Grupos de trabajos</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <a href="{{ route('grupotrabajos.index') }}" class="small-box-footer">
          Más información <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- Vehículos -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{{ $carCount }}</h3>
          <p>Vehículos disponibles</p>
        </div>
        <div class="icon">
          <i class="fas fa-truck"></i>
        </div>
        <a href="{{ route('cars.index') }}" class="small-box-footer">
          Más información <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- Usuarios -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $userCount }}</h3>
          <p>Usuarios registrados</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-plus"></i>
        </div>
        <a href="{{ route('users.index') }}" class="small-box-footer">
          Más información <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <!-- Servicios -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $carServiceCount }}</h3>
          <p>Servicios programados</p>
        </div>
        <div class="icon">
          <i class="fas fa-wrench"></i>
        </div>
        <a href="{{ route('carservicedates.index') }}" class="small-box-footer">
          Más información <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>

@endsection
