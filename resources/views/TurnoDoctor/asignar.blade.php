@extends('layouts.template')

@section('header')Asignar Turnos @endsection

@section('content')
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5" >
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <h1>Asignar turno a: {{$doctor->persona->nombre}}</h1>
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
                            <form class="user" action="{{ route('turno-doctor.store',['doctor'=>$doctor]) }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <label class="input-group-text" for="inputGroupSelect01">Turnos</label>
                                    </div>
                                    <select name="turno" id="turno" class="custom-select">
                                        @foreach ($turnos as $turno)
                                        <option value="{{$turno->id}}">{{$turno->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <h6>Seleccionar los dias de servicio para el turno</h6>
                                    <div class="row ">
                                        @foreach ($Dias as $dia)
                                            <div >
                                                <input id="dia.{{$dia}}"class="form-check-input "  type="checkbox" name="dias[]" value="{{$dia}}">
                                                <label for="dia.{{$dia}}" class="form-check-label">{{$dia}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                                <div class="form-group row m-5" >
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a href="{{ url()->previous() }}"
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