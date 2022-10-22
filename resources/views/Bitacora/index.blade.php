@extends('layouts.template')

@section('header')Registro de bitacora @endsection

@section('content')
<div class="container-fluid">
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bitacoras registradas</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>Objeto</th>
                        <th>Entidad</th>
                        <th>Accion</th>
                        <th>fecha</th>
                        <th>Autor</th>
                        <th>Opciones</th>
                    </tr>
                    @foreach ($Bitacoras as $bitacora)
                    <tr>
                        <td>{{$bitacora->id}}</td>
                        <td>{{$bitacora->objeto}}</td>
                        <td>{{$bitacora->entidad_descripcion}}</td>
                        <td>{{$bitacora->verbo}}</td>
                        <td>{{$bitacora->fecha_hora}}</td>
                        <td>{{$bitacora->nombre_completo}}</td>
                        <td>
                            <a href="{{route('bitacora.show',['bitacora'=>$bitacora])}}" class="btn btn-info btn-sm">ver mas</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>    
</div>
@endsection