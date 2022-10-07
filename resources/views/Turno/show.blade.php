@extends('layouts.template')

@section('header')Datos del turno: {{$turno->descripcion}} @endsection

@section('content')
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5" >
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <h1>Datos del turno</h1>
                            <form class="user" >
                                <div class="form-row">
                                    <div class="form-group col-12 ">
                                        <label for="descripcion">Descripcion:</label>
                                        <input class="form-control form-control-user"  readonly type="text" name="descripcion" id="descripcion" value="{{$turno->descripcion}}">
                                    </div>
                                    <div class="form-group col md-6">
                                        <label for="hora_inicio">El turno empieza desde</label>
                                        <input class="form-control form-control-user"  readonly  type="time" name="hora_inicio" id="hora_inicio" value="{{$turno->hora_inicio}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="hora_fin">El turno termina a las:</label>
                                        <input class="form-control form-control-user" readonly   type="time" name="hora_fin" id="hora_fin" value="{{$turno->hora_fin}}">
                                    </div>
                                </div>
                                <div class="form-group row m-5" >
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a href="{{ route('turno.index') }}"
                                            class="btn btn-primary btn-user btn-block">
                                            Volver
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