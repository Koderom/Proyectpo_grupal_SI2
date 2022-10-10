@extends('layouts.template')

@section('header')Gestionar Agenda @endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row row-2 p-2">
                <h3 class="col">Agenda del doctor: <strong>{{$doctor->persona->nombre}}</strong></h3>
                <a href="{{route('agenda.create',['doctor'=>$doctor])}}" class="btn btn-success btn-icon-split col-3"><span class="text">Agregar a la agenda</span></a>    
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Cupos totales</th>
                        <th>Cupos reservados</th>
                        <th>Cupos libres</th>
                        <th>Opciones</th>    
                    </tr>
                    @foreach ($Agendas as $agenda)
                    <tr>
                        <td>{{$agenda->id}}</td>
                        <td>{{$agenda->fecha}}</td>
                        <td>50</td>
                        <td>45</td>
                        <td>5</td>
                        <td>
                            <a href="{{route('agenda.ver-cupos',['doctor'=>$doctor,'agenda'=>$agenda])}}" class="btn btn-info btn-sm fas fa-edit  cursor-pointer"> Ver Cupos</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <a href="{{ route('agenda.index') }}"
                        class="btn btn-primary btn-user btn-block">
                        Atras
                    </a>
                </div>
            </div>
        </div>
    </div>    
</div>

@endsection