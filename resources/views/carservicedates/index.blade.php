@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="mb-4">Mantenimientos</h1>

    <div class="mb-3" style="text-align: right;">
        <a href="{{ route('cars.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Historial de Mantenimientos
        </a>
    </div>