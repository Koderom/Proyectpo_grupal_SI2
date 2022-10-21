<!DOCTYPE html>
<html lang="en">

<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu administrador</title>

    <!-- Custom fonts for this template-->

    <link href="{{asset('adminTemplate/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/adminTemplate/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="menu">
                <!--<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>

                </div>-->
                <div class="sidebar-brand-text mx-3">DOCLINIC</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Menu</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Administrar Usuario</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestionar:</h6>
                        @can('ver.usuario')
                        <a class="collapse-item" href="{{asset('/usuario')}}">Usuario</a>
                        @endcan
                        
                        @can('ver.roles')
                        <a class="collapse-item" href="{{route('roles.index')}}">Roles y permiso</a>
                        @endcan
                        
                        @can('ver.administrativo')
                        <a class="collapse-item" href="{{asset('/administrativo')}}">Personal Administrativo</a>
                        @endcan
                        
                        @can('ver.medico')
                        <a class="collapse-item" href="{{asset('/doctores')}}">Medico</a>
                        @endcan
                        
                        @can('ver.paciente')
                        <a class="collapse-item" href="{{asset('/paciente')}}">Paciente</a>
                        @endcan
                        
                        @can('ver.bitacora')
                        <a class="collapse-item" href="{{route('bitacora.index')}}">Bitacora</a>
                        @endcan
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Administrar Documento</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestionar:</h6>
                        @can('ver.documentacion')
                        <a class="collapse-item" href="{{asset('/documentacion')}}">Documentacion</a>
                        @endcan
                        
                        @can('ver.historial-clinico')
                        <a class="collapse-item" href="{{asset('/historial;')}}">Historial Clinico</a>
                        @endcan
                        
                        @can('ver.hoja-de-consulta')
                        <a class="collapse-item" href="{{asset('/consulta')}}">Hoja de consulta</a>
                        @endcan
                        
                        @can('ver.receta')
                        <a class="collapse-item" href="{{asset('/recetas')}}">Recetas</a>
                        @endcan
                        
                        
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Administrar Servicio</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestionar:</h6>
                        
                        
                        @can('ver.agenda')
                        <a class="collapse-item" href="{{route('agenda.index')}}">Agenda</a>
                        @endcan
                        
                        @can('ver.reservar cita')
                        <a class="collapse-item" href="{{route('cita.paciente.reservar')}}">Resevar Cita</a>
                        @endcan
                        
                        @can('ver.mis-citas')
                        <a class="collapse-item" href="{{route('cita.paciente.verCitas')}}">Mis citas</a>
                        @endcan
                        
                        @can('ver.mis-agendas')
                        <a class="collapse-item" href="{{route('cita.medico.verAgenda')}}">Mi agenda</a>
                        @endcan
                        
                        {{-- @can('ver.turnos')
                        <a class="collapse-item" href="{{asset('/Horario')}}">Horarios</a>
                        @endcan --}}
                        
                        @can('ver.turnos')
                        <a class="collapse-item" href="{{route('turno.index')}}">Turnos</a>
                        @endcan
                        
                        @can('ver.especialidades')
                        <a class="collapse-item" href="{{asset('/consulta')}}">Especialidades</a>
                        @endcan
                        
                        
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Administrar Ambiente</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestionar:</h6>
                        
                        @can('ver.sectores')
                        <a class="collapse-item" href="{{route('sector.index')}}">Sectores</a>
                        @endcan
                        
                        @can('ver.quirofano')
                        <a class="collapse-item" href="{{asset('/quirofano')}}">Quirofano</a>
                        @endcan
                        
                        @can('ver.consultorio')
                        <a class="collapse-item" href="{{asset('/consultorio')}}">Consultorio</a>
                        @endcan

                        @can('ver.internacion')
                        <a class="collapse-item" href="{{asset('/internacion')}}">Internacion</a>
                        @endcan
                        

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Reportes
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Administrar Reportes</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestionar:</h6>
                        @can('ver.reportes')
                        <a class="collapse-item" href="{{asset('/reporte_personal')}}">Reportes del personal</a>
                        @endcan
                        @can('ver.reportes')
                        <a class="collapse-item" href="{{asset('/reporte_atencion')}}">Reportes de atencion</a>
                        @endcan
                        <form action="{{asset('logout')}}" method="POST">
                            {{ csrf_field() }}
                        <button class="dropdown-item" href="#">
                            <a class="collapse-item">cerrar sesion</a>
                        </button>
                        </form>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Nav Item - Charts -->
            <!--
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>
            -->
            <!-- Nav Item - Tables -->
            <!--
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Tables</span></a>
            </li>
            -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    @yield('usuario')
                                </span >
                                <img class="img-profile rounded-cir{cle"
                                    src="{{asset('/adminTemplate/img/sesion.png')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!--<a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>-->
                                <!--<a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>-->
                                <!--<a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>-->
                                <!--<div class="dropdown-divider"></div>-->
                                <form action="{{asset('logout')}}" method="POST">
                                    {{ csrf_field() }}
                                <button class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('header')</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
                    </div>
                    <!-- content Row-->
                    <div class="row" >

                        @yield('content')

                    </div>


                </div>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">

            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->


    <!-- Bootstrap core JavaScript-->


    <script src="{{asset('/adminTemplate/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/adminTemplate/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('/adminTemplate/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('/adminTemplate/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('/adminTemplate/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('/adminTemplate/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('/adminTemplate/js/demo/chart-pie-demo.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('/adminTemplate/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/adminTemplate/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('/adminTemplate/js/demo/datatables-demo.js')}}"></script>

</body>

</html>