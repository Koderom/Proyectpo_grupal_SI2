@extends('layouts.template')

@section('header')Registrar nuevo Turno @endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-5 bg-white" style="border-radius: 1rem">
            <div class="card-body ">
                <h3>Reservar Cita </h3>
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
                <form class="user" action="{{route('cita.store',['cupo'=>$cupo])}}" method="POST">
                    @csrf
                    <div class="form-row p-3">
                        <div class="form-group col-12 ">
                            <label for="paciente">Selecciones un paciente:</label>
                            <select name="paciente" id="paciente" class="form-control">
                                @foreach ($Pacientes as $paciente)
                                    <option value="{{$paciente->id}}">Nombre: {{$paciente->persona->nombre}} - CI: {{$paciente->persona->ci}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 ">
                            <label for="motivo">Motivo de la cita:</label>
                            <textarea class="form-control"  type="text" name="motivo" id="motivo" value="{{old('motivo')}}"></textarea>
                        </div>
                    </div>
                    <div class="form-group row m-5" >
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                        </div>
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