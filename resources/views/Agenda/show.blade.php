@extends('layouts.template')

@section('header')Gestionar Agenda @endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2>Agendas del doctor: {{$doctor->persona->nombre}}</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Opciones</th>    
                    </tr>
                    @foreach ($Doctores as $doctor)
                    <tr>
                        <td>{{$doctor->id}}</td>
                        <td>{{$doctor->persona->nombre}}</td>
                        <td>{{$doctor->especialidad->nombre}}</td>
                        <td>
                            <a href="{{route('agenda.show',['doctor'=>$doctor])}}" class="btn btn-info btn-sm fas fa-edit  cursor-pointer"> Ver Agenda</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>    
</div>

@endsection