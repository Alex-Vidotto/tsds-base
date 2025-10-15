<<<<<<< HEAD
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Título -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center">Gestión de Tareas</h2>
            <p class="text-center text-muted">Listado general de tareas</p>
        </div>
    </div>

    <!-- Botón Nueva Tarea -->
    <<div class="mb-3" style="text-align: right;">
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#nuevoServicioModal">
        <i class="fas fa-plus"></i> Nueva Tarea
    </button>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="nuevoServicioModal" tabindex="-1" role="dialog" aria-labelledby="nuevoServicioModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nuevoServicioModalLabel">Nueva Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form id="formNuevaTarea" class="d-flex flex-column gap-2 align-items-center" action="{{ route('tareas.store') }}" method="POST">
            @csrf
            <input type="text" name="titulo" placeholder="Título de la tarea" class="form-control mb-2" required>
            <button type="submit" class="btn btn-outline-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-striped" id="tablaDetalles">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Servicio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tareas as $tarea)
                    <tr>
                        <td>{{ $tarea->id }}</td>
                        <td>{{ $tarea->titulo }}</td>
                        <td>
                            <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning btn-sm text-white">Editar</a>
                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
=======

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Tareas') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table" id="tablaDetalles">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Servicio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tareas as $tarea)
                                <tr>
                                    <td>{{ $tarea->id }}</td>
                                    <td>{{ $tarea->titulo }}</td>
                                    <td>
                                        <a href = "{{ route('tareas.edit', $tarea->id) }}" class = "btn btn-warning btn-sm">Editar</a>
                                            <form action = "{{ route('tareas.destroy' , $tarea->id) }}" method = "POST" style = "display:inline-block;">
                                                @csrf
                                                @method ('DELETE')
                                                <button type = "submit" class = "btn btn-danger btn-sm" onclick = "return confirm('¿Estas seguro de eliminar esta tarea')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="/tareas" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="text" name="titulo" placeholder="Nueva tarea" class="form-control" required>
                        <button type="submit" class="btn btn-outline-primary">Agregar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
>>>>>>> master
</div>
@endsection

@push('scripts')
<<<<<<< HEAD


<script>
  $(document).ready(function() {
    // Verificá que jQuery está definido
    if (typeof $ === 'undefined') {
      console.error('jQuery NO está cargado.');
      return;
    }
    console.log('jQuery cargado OK');

    // Verificá que el formulario existe en el DOM
    let $form = $('#formNuevaTarea');
    if ($form.length === 0) {
      console.error('#formNuevaTarea no existe en el DOM');
      return;
    }
    console.log('Formulario detectado');

    $form.on('submit', function(e) {
      e.preventDefault();  // previene el envío normal
      console.log('submit capturado!');

      let titulo = $(this).find('input[name="titulo"]').val();

      $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: {
          titulo: titulo,
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          console.log('respuesta:', response);
          // Podés recargar la tabla o el contenido
          // Aquí podés cerrar el modal, etc.
        },
        error: function(xhr) {
          console.error('Error en Ajax:', xhr);
        }
      });
    });
  });
</script>
@endpush

=======
    <script>
        $(document).ready(function() {
            console.log("jQuery LISTO!");
        });

        $(document).ready(function(){
            $('#tablaDetalles').DataTable({
                "language":{
                        "info": "_TOTAL_ registros",
                        "search": "Buscar",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                        },
                        "lengthMenu": 'Mostrar <select class="form-select form-select-sm ms-1 me-1">'+
                                      '<option value="5">5</option>'+
                                      '<option value="10">10</option>'+
                                      '<option value="20">20</option>'+
                                      '<option value="50">50</option>'+
                                      '<option value="-1">Todos</option>'+
                                      '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias",
                        "infoEmpty": "",
                        "infoFiltered": ""
                }
            })
        })
    </script>
@endpush
>>>>>>> master
