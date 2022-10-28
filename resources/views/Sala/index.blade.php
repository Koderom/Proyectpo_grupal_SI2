@extends('layouts.template')

@section('header')Gestionar Salas @endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    
    <p class="mb-4"></p>       
    <a href="{{route('sala.create')}}" class="btn btn-success btn-icon-split">
        <span class="text">Registrar Salas</span>
    </a>
    <div class="my-2"></div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Salas registrados</h6>
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
                            <th>Tipo de sala</th>
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
                            <th>Tipo de sala</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Salas as $sala)
                          
                            <tr>
                                <td>{{$sala->id}}</td>
                                <th>{{$sala->nro_sala}}</th>
                                <th>{{$sala->capacidad}}</th>
                                <th>{{$sala->sector->nombre}}</th>
                                <th>{{$sala->sector->piso}}</th>
                                @switch($sala->tipo_sala[0])
                                    @case('I')
                                        <th>Internacion</th>
                                        @break
                                    @case('C')
                                        <th>Consultorio</th>    
                                        @break
                                    @case('Q')
                                        <th>Quirofano</th>
                                        @break    
                                @endswitch
                                <td>
                                    <a href="{{route('sala.verMas',['sala'=>$sala])}}" class="btn btn-info btn-sm fas fa-eye cursor-pointer"> ver mas</a>
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