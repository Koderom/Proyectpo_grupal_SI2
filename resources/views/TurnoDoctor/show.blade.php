@extends('layouts.template')

@section('header')Ver turnos @endsection

@section('content')
    
<div class="card  o-hidden border-0 shadow-lg m-3 p-3 container" >
    <div class="card-body">
        <div class="row p-3">
            <h4 class="col-md-9">Turnos asignados a: <strong>{{$doctor->persona->nombre}}</strong></h4>
            <div class="col-md-3">
                <a href="{{route('turno-doctor.asignar',['doctor'=>$doctor])}}" class="btn btn-info btn-sm cursor-pointer">Asignar nuevo turno</a> 
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Horarios de trabajo de los doctores</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Turno</th>
                    <th>Dia</th>
                    <th>Hora inicio</th>
                    <th>Hora fin</th>
                    <th>Opciones</th>    
                </tr>
                @foreach ($Doc_turnos as $doc_turno)
                <tr>
                    <td>{{$doc_turno->id}}</td>
                    <td>{{$doc_turno->turno->descripcion}}</td>
                    <td>{{$doc_turno->dia_atencion}}</td>
                    <td>{{$doc_turno->turno->hora_inicio}}</td>
                    <td>{{$doc_turno->turno->hora_fin}}</td>
                    <td>
                        <form action="{{route('turno-doctor.destroy',['turno_doctor'=>$doc_turno])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm fas fa-trash-alt cursor-pointer"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="form-group row m-5" >
        <div class="col-sm-6 mb-3 mb-sm-0 centrar-gp" >
            <a href="{{route('turno.index')}} "
                class="btn btn-primary btn-user btn-block">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection