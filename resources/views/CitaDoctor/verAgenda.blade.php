@extends('layouts.template')

@section('header')Mi Agenda @endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row  p-2">
                <h3 class="col-auto col-md-7">Agenda de: <strong>{{$doctor->persona->nombre}}</strong></h3>
                <h4 class="col-auto">Para la fecha: <strong>{{$agenda->fecha}}</strong></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row p-3">
                @foreach ($Cupos as $cupo)
                <div class="col-xl-3 col-lg-4 col-sm-6 ">
                    <div class="card bg-light mb-3" style="max-width: 18rem;">
                        
                    @switch($cupo->estado)
                        @case('R')
                            <div class="card-header">
                                <span class="row">Cupo Nª: <strong>{{$cupo->id}}</strong> </span> 
                            </div>
                                <div class="card-body">
                                    <h5 class="card-title"><span class="">Hora: {{ Str::substr($cupo->hora_inicio,0,5) }}-{{ Str::substr($cupo->hora_fin,0,5) }}</span> </h5>
                                    <p class="card-text">Paciente: {{$cupo->cita->paciente->persona->nombre}}</p>
                                    <div>
                                        <span class="text-secondary">Reservado</span>
                                        <a href="{{route('cita.create',['cupo'=>$cupo])}}" class="col">Confirma</a>    
                                    </div>
                                </div>
                            </div>
                            @break
                        @case('C')
                            <div class="card-header">
                                <span class="row">Cupo Nª: <strong>{{$cupo->id}}</strong> </span> 
                            </div>
                                <div class="card-body">
                                    <h5 class="card-title"><span class="">Hora: {{ Str::substr($cupo->hora_inicio,0,5) }}-{{ Str::substr($cupo->hora_fin,0,5) }}</span> </h5>
                                    <p class="card-text">Paciente: {{$cupo->cita->paciente->persona->nombre}}</p>
                                    <div>
                                        <span class="text-success">Confirmado</span>
                                        <a href="{{route('cita.create',['cupo'=>$cupo])}}" class="col">Ver</a>    
                                    </div>
                                </div>
                            </div>
                            @break
                        @default
                        <div class="card-header">
                            <span class="row">Cupo Nª: <strong>{{$cupo->id}}</strong> </span> 
                        </div>
                            <div class="card-body">
                                <h5 class="card-title"><span class="">Hora: {{ Str::substr($cupo->hora_inicio,0,5) }}-{{ Str::substr($cupo->hora_fin,0,5) }}</span> </h5>
                                <div>
                                    <span class="text-info">Disponible</span>
                                    <a href="{{route('cita.create',['cupo'=>$cupo])}}" class="col">Reservar</a>    
                                </div>
                            </div>
                        </div>
                    @endswitch
                </div>    
                @endforeach
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <a href="{{ route('agenda.show',['doctor'=>$doctor]) }}"
                    class="btn btn-primary btn-user btn-block">
                    Atras
                </a>
            </div>
            
        </div>
    </div>    
</div>

@endsection