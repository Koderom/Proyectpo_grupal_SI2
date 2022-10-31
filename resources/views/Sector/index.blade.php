@extends('layouts.template')

@section('header')Sectores @endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    
    <p class="mb-4"></p>       
    <a href="{{route('sector.create')}}" class="btn btn-success btn-icon-split">
        <span class="text">Registrar Sector</span>
    </a>
    <div class="my-2"></div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sectores registrados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Ubicacion</th>
                            <th>Funcionalidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Ubicacion</th>
                          <th>Funcionalidad</th>
                          <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Sectores as $sector)
                          
                            <tr>
                                <td>{{$sector->id}}</td>
                                <th>{{$sector->nombre}}</th>
                                <th>{{$sector->piso}}</th>
                                <th>{{$sector->funcionalidad}}</th>
                                <td>
                                    <form action="{{route('sector.destroy',['sector'=>$sector])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="#" class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                                        <a href="{{route('sector.edit',['sector'=>$sector])}}"
                                            class="btn btn-primary btn-sm fas fa-edit  cursor-pointer"></a>
                                        <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                            onclick="return confirm('¿ESTA SEGURO QUE DESEA ELIMINAR?')" value="Borrar">
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