@extends('layouts.template')

@section('header')Datos de la cita medica @endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-5 bg-white" style="border-radius: 1rem">
            <div class="card-body ">
                <h3>Cita para: 
                    {{$cupo->cita->paciente->persona->nombre}}
                    {{$cupo->cita->paciente->persona->apellido_paterno}}
                    {{$cupo->cita->paciente->persona->apellido_materno}}
                </h3>
                <form class="user" action="#" method="POST">
                    <div class="form-row p-3">
                        <div class="form-group col-12 ">
                            <label for="motivo">Motivo de la cita:</label>
                            <span class="form-control" >{{$cupo->cita->motivo}}</span>
                        </div>
                        <div class="form-group col-6 ">
                            <label >hora de inicio:</label>
                            <span name="motivo" class="form-control" >{{$cupo->hora_inicio}}</span>
                        </div>
                        <div class="form-group col-6 ">
                            <label for="motivo">hora de fin:</label>
                            <span class="form-control" >{{$cupo->hora_fin}}</span>
                        </div>
                        <div class="form-group col-6 ">
                            <label for="motivo">Fecha programada:</label>
                            <span class="form-control" >{{$cupo->cita->fecha_cita}}</span>
                        </div>
                        <div class="form-group col-6 ">
                            <label for="motivo">Especialidad:</label>
                            <span class="form-control" >{{$cupo->cita->especialidad->nombre}}</span>
                        </div>
                        <div class="form-group col-6 ">
                            <label for="motivo">Medico encargado:</label>
                            <span class="form-control" >
                                {{$cupo->cita->doctor->persona->nombre}} 
                                {{$cupo->cita->doctor->persona->apellido_paterno}} 
                                {{$cupo->cita->doctor->persona->apellido_materno}}
                            </span>
                        </div>
                        <div class="form-group col-6 ">
                            <label for="motivo">Confirmado por:</label>
                            <span class="form-control" >
                                {{$cupo->cita->administrativo->persona->nombre}} 
                                {{$cupo->cita->administrativo->persona->apellido_paterno}} 
                                {{$cupo->cita->administrativo->persona->apellido_materno}}
                            </span>
                        </div>
                    </div>
                    <div class="form-group row m-5" >
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <a href="{{url()->previous()}}"
                                class="btn btn-primary btn-user btn-block">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
@endsection