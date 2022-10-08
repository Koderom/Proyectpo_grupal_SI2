@extends('layouts.template')

@section('header')Asignar Turnos @endsection

@section('content')
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5" >
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <h1>Asignar turno</h1>
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
                            <form class="user" action="{{ route('turno.store') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <label class="input-group-text" for="inputGroupSelect01">Usuarios: </label>
                                    </div>
                                    <select name="usuario" id="usuario" class="custom-select">
                                        @foreach ($Doctores as $doctor)
                                        <option value="{{$doctor->id}}">{{$doctor->persona->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <label class="input-group-text" for="inputGroupSelect01">Usuarios: </label>
                                    </div>
                                    <select name="usuario" id="usuario" class="custom-select">
                                        @foreach ($Turnos as $turno)
                                        <option value="{{$turno->id}}">{{$turno->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-12 ">
                                        <label for="descripcion">Ingrese una descripcion:</label>
                                        <input class="form-control form-control-user"  type="text" name="descripcion" id="descripcion" value="{{old('descripcion')}}">
                                    </div>
                                    <div class="form-group col md-6">
                                        <label for="hora_inicio">El turno empieza desde::</label>
                                        <input class="form-control form-control-user"  type="time" name="hora_inicio" id="hora_inicio" value="{{old('hora_inicio')}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="hora_fin">El turno termina a las:</label>
                                        <input class="form-control form-control-user"  type="time" name="hora_fin" id="hora_fin" value="{{old('hora_fin')}}">
                                    </div>
                                </div>
                                <div class="form-group row m-5" >
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a href="{{ route('turno.index') }}"
                                            class="btn btn-primary btn-user btn-block">
                                            Cancelar
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection