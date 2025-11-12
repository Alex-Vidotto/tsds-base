<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PROYECTO Seven y-Eleven | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
      </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://asistencia.claro.com.ar/asistencia/servicios-en-tu-casa/soporte/como-hago-para-reclamar-o-consultar-por-la-instalacion" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  
  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" 
             alt="Logo" 
             class="brand-image img-circle elevation-3" 
             style="opacity: .8">
        <span class="brand-text font-weight-light">Seven y-Eleven</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" 
                     class="img-circle elevation-2" 
                     alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('users.edit', Auth::user()) }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" 
                data-widget="treeview" 
                role="menu" 
                data-accordion="false">

                <li class="nav-header">MENÚ PRINCIPAL</li>

                <li class="nav-item">
                    <a href="{{  route('users.index')  }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Usuarios</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('grupotrabajos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Grupos de trabajos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cars.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-car"></i>
                        <p>Vehículos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tareas.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>Servicios</p>
                    </a>
                </li>

                <li class="nav-header">CONFIGURACIÓN</li>

                                                                <li class="nav-item has-treeview">

                                                                    <a href="#" class="nav-link">

                                                                        <i class="nav-icon fas fa-cog"></i>

                                                                        <p>

                                                                            Parámetros

                                                                            <i class="right fas fa-angle-left"></i>

                                                                        </p>

                                                                    </a>

                                                                    <ul class="nav nav-treeview">

                                                                        <li class="nav-item">

                                                                            <a href="#" class="nav-link" id="sidebar-dark-mode-toggle">

                                                                                <i class="far fa-circle nav-icon"></i>

                                                                                <p>Modo Dark</p>

                                                                            </a>

                                                                        </li>

                                                                        <li class="nav-item">

                                                                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">

                                                                                @csrf

                                                                                <button type="submit" class="nav-link btn btn-link p-0" style="color: #c2c7d0; width: 100%; text-align: left;">

                                                                                    <i class="far fa-circle nav-icon"></i>

                                                                                    <p>Salir</p>

                                                                                </button>

                                                                            </form>

                                                                        </li>

                                                                    </ul>

                                                                </li>

                                                            </ul>

                                                        </nav>

                                                        <!-- /.sidebar-menu -->

                                                    </div>

                                                    <!-- /.sidebar -->

                                                </aside>

                                                

                                                  <!-- Content Wrapper. Contains page content -->

                                                  <div class="content-wrapper">

                                                    <br>

                                                    <!-- Main content -->

                                                    <section class="content">

                                                      <div class="container-fluid"> 

                                                          

                                                

                                                

                                                         

                                                                  @yield('content')	

                                                

                                                     

                                                      

                                                      </div>

                                                      </section>

                                                       <!-- /.content-wrapper -->

                                                

                                                

                                                

                                                

                                                

                                                

                                                

                                                

                                                

                                                    <!-- Control Sidebar -->

                                                    <aside class="control-sidebar control-sidebar-dark">

                                                      <!-- Control sidebar content goes here -->

                                                    </aside>

                                                    <!-- /.control-sidebar -->

                                                </div>

                                                <!-- ./wrapper -->

                                                

                                                <!-- jQuery -->

                                                <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

                                                <!-- jQuery UI 1.11.4 -->

                                                <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

                                                <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

                                                <script>

                                                  $.widget.bridge('uibutton', $.ui.button)

                                                </script>

                                                <!-- Bootstrap 4 -->

                                                <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

                                                <!-- ChartJS -->

                                                <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

                                                <!-- Sparkline -->

                                                <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>

                                                <!-- JQVMap -->

                                                <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>

                                                <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

                                                <!-- jQuery Knob Chart -->

                                                <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>

                                                <!-- daterangepicker -->

                                                <script src="{{asset('plugins/moment/moment.min.js')}}"></script>

                                                <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

                                                <!-- Tempusdominus Bootstrap 4 -->

                                                <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

                                                <!-- Summernote -->

                                                <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>

                                                <!-- overlayScrollbars -->

                                                <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

                                                <!-- AdminLTE App -->

                                                <script src="{{asset('dist/js/adminlte.js')}}"></script>

                                                <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

                                                <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>

                                                

                                                

                                                

                                                <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>

                                                

                                                <!-- agregamos estido al paginate de Jquery DataTable -->

                                                <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

                                                

                                                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                                                

                                                <script>

                                                    // Aplicar modo oscuro si está guardado

                                                    if (localStorage.getItem('darkMode') === 'enabled') {

                                                        document.body.classList.add('dark-mode');

                                                        document.querySelectorAll('.navbar, .card').forEach(el => el.classList.add('dark-mode'));

                                                    }

                                                

                                                    // Toggle al hacer clic en el botón de la barra de navegación

                                                    document.getElementById('dark-mode-toggle').addEventListener('click', function () {

                                                        document.body.classList.toggle('dark-mode');

                                                        document.querySelectorAll('.navbar, .card').forEach(el => el.classList.toggle('dark-mode'));

                                                

                                                        // Guardar preferencia

                                                        if (document.body.classList.contains('dark-mode')) {

                                                            localStorage.setItem('darkMode', 'enabled');

                                                        } else {

                                                            localStorage.setItem('darkMode', 'disabled');

                                                        }

                                                    });

                                                

                                                    // Toggle al hacer clic en el botón del sidebar

                                                    document.getElementById('sidebar-dark-mode-toggle').addEventListener('click', function (e) {

                                                        e.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

                                                        document.body.classList.toggle('dark-mode');

                                                        document.querySelectorAll('.navbar, .card').forEach(el => el.classList.toggle('dark-mode'));

                                                

                                                        // Guardar preferencia

                                                        if (document.body.classList.contains('dark-mode')) {

                                                            localStorage.setItem('darkMode', 'enabled');

                                                        } else {

                                                            localStorage.setItem('darkMode', 'disabled');

                                                        }

                                                    });

                                                </script>

                                                

                                                @stack('scripts')

                                                

                                                </body>

                                                </html>

                                                

                                

                