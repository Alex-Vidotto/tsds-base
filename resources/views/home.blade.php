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
      <h3>5</h3>
      <p>Grupos de trabajos</p>
    </div>
    <div class="icon">
      <i class="fas fa-users"></i>
    </div>
  </div>
</div>


    <!-- Stock -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>3</h3>
          <p>Notificaciones de Stock</p>
        </div>
        <div class="icon">
          <i class="fas fa-boxes"></i>
        </div>
      </div>
    </div>

    <!-- Órdenes de trabajo -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>8</h3>
          <p>Órdenes de trabajo activas</p>
        </div>
        <div class="icon">
          <i class="fas fa-file-alt"></i>
        </div>
      </div>
    </div>

    <!-- Vehículos -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>4</h3>
          <p>Vehículos disponibles</p>
        </div>
        <div class="icon">
          <i class="fas fa-truck"></i>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
