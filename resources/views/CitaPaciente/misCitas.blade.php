@extends('layouts.template')

@section('header')Mis Citas @endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row  p-2">
                <h3 class="col-auto col-md-7">Citas de: <strong>
                    {{$paciente->persona->nombre}}
                    {{$paciente->persona->primer_apellido}}
                    {{$paciente->persona->primer_materno}}
                </strong></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row p-3">
                @foreach ($Citas as $cita)
                <div class="col-xl-3 col-lg-4 col-sm-6 ">
                    <div class="card bg-light mb-3" style="max-width: 18rem;">
                        
                    @switch($cita->cupo->estado)
                        @case('R')
                            <div class="card-header">
                                <span class="row">Fecha: <strong>{{$cita->fecha_cita}}</strong> </span> 
                            </div>
                                <div class="card-body">
                                    <span class="text-info">{{$cita->doctor->especialidad->nombre}}</span><br>
                                    <h5 class="card-title"><span class="">Hora: {{ Str::substr($cita->cupo->hora_inicio,0,5) }}-{{ Str::substr($cita->cupo->hora_fin,0,5) }}</span> </h5>
                                    <p class="card-text"> <strong>Doctor:</strong> 
                                        {{$cita->doctor->persona->nombre}}
                                        {{$cita->doctor->persona->apellido_paterno}}
                                        {{$cita->doctor->persona->apellido_materno}}
                                    </p>
                                    <div>
                                        <span class="text-warning">Reservado</span>
                                    </div>
                                </div>
                            </div>
                            @break
                        @case('C')
                            <div class="card-header">
                                <span class="row">Fecha: <strong>{{$cita->fecha_cita}}</strong> </span> 
                            </div>
                                <div class="card-body">
                                    <span class="text-info">{{$cita->doctor->especialidad->nombre}}</span><br>
                                    <h5 class="card-title"><span class="">Hora: {{ Str::substr($cita->cupo->hora_inicio,0,5) }}-{{ Str::substr($cita->cupo->hora_fin,0,5) }}</span> </h5>
                                    <p class="card-text"> <strong>Doctor:</strong> 
                                        {{$cita->doctor->persona->nombre}}
                                        {{$cita->doctor->persona->apellido_paterno}}
                                        {{$cita->doctor->persona->apellido_materno}}
                                    </p>
                                    <div>
                                        <span class="text-success">Confirmado</span>
                                        <a href="{{route('cita.show',['cupo'=>$cita->cupo])}}" class="col">Ver</a>    
                                    </div>
                                </div>
                            </div>
                            @break
                        @default
                    @endswitch
                </div>    
                @endforeach
            </div>
        </div>
    </div>    
</div>

@endsection