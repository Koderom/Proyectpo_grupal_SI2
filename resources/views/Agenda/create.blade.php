@extends('layouts.template')

@section('header')Registrar nuevo Turno @endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-5 bg-white" style="border-radius: 1rem">
            <div class="card-body ">
                <h3>Registrar en la egenda de: <strong>{{$doctor->persona->nombre}}</strong></h3>
                {{ csrf_field() }}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="user" action="{{route('agenda.store',['doctor'=>$doctor])}}" method="POST">
                    @csrf
                    <div class="form-row p-3">
                        <div class="form-group col-6 ">
                            <label for="fecha_agendar">Ingrese una fecha a agendar:</label>
                            <input class="form-control form-control-user"  type="date" name="fecha_agendar" id="fecha_agendar" value="{{old('fecha_agendar')}}">
                        </div>
                        <div class="form-group col md-6">
                            <label for="cantidad_cupos">Ingresar la catidad de cupos habilitados:</label>
                            <input class="form-control form-control-user"  type="number" name="cantidad_cupos" id="cantidad_cupos" value="{{old('cantidad_cupos')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora_inicio">Integrese la hora de principio de atencion:</label>
                            <input class="form-control form-control-user"  type="time" name="hora_inicio" id="hora_inicio" value="{{old('hora_inicio')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora_fin">Integrese la hora de finalizacion de atencion</label>
                            <input class="form-control form-control-user"  type="time" name="hora_fin" id="hora_fin" value="{{old('hora_fin')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="minutos">Intese la catidad de minutos dedicados al paciente:</label>
                            <input class="form-control form-control-user"  type="number" name="minutos" id="minutos" value="{{old('minutos')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cantidad_dia">cantidad de dias a agendar a partir de la fecha: (opcional) </label>
                            <input class="form-control form-control-user"  type="number" name="cantidad_dia" id="cantidad_dia" value="{{old('cantidad_dia')}}">
                        </div>
                    </div>
                    <div class="form-group row m-5" >
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <a href="{{route('agenda.show',['doctor'=>$doctor])}}"
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