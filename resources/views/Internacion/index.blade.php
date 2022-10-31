@extends('layouts.template')

@section('header')Salas de Internacion @endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    
    <p class="mb-4"></p>       
    <a href="{{route('internacion.create')}}" class="btn btn-success btn-icon-split">
        <span class="text">Registrar sala de internacion</span>
    </a>
    @include('TipoInternacion.modalCreate')
    <a href="{{route('internacion.internarPaciente')}}" class="btn btn-success btn-icon-split">
        <span class="text">Internar paciente</span>
    </a>
    <div class="my-2"></div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Salas de internacion registrados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nro de sala</th>
                            <th>Capacidad</th>
                            <th>Sector</th>
                            <th>Piso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nro de sala</th>
                            <th>Capacidad</th>
                            <th>Sector</th>
                            <th>Piso</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($SalasInternacion as $sala)
                          
                            <tr>
                                <td>{{$sala->id}}</td>
                                <th>{{$sala->nro_sala}}</th>
                                <th>{{$sala->capacidad}}</th>
                                <th>{{$sala->sector->nombre}}</th>
                                <th>{{$sala->sector->piso}}</th>
                                <td>
                                    <form action="{{route('internacion.destroy',['sala'=>$sala])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('internacion.show',['sala'=>$sala])}}" class="btn btn-info btn-sm fas fa-eye cursor-pointer"> ver mas</a>
                                        <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                            onclick="return confirm('¿ESTA SEGURO DE  BORRAR?')" value="Borrar">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->    
@endsection