@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 18rem;">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bienvenido') }}
                </div>
                <a href="{{ route('tareas.index') }}" class="btn btn-outline-primary">
                    Ir a Tareas
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
