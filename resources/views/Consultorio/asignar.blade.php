@extends('layouts.template')

@section('header')Gestionar consultorio @endsection

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 3rem">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Asignar consultorio</h1>
                        </div>
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
                        <form class="user" action="{{route('asignacionConsultorio.store')}}"  method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label for="doctor">Seleccionar doctor:</label>
                              <select name="doctor" id="doctor" class="form-control" style="border-radius: 3rem">
                                @foreach ($Doctores as $doctor)
                                  <option value="{{$doctor->id}}">
                                    {{$doctor->id}}-
                                    {{$doctor->persona->nombre}}
                                    {{$doctor->persona->apellido_paterno}}
                                    {{$doctor->persona->apellido_materno}}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label for="sala">Seleccionar consultorio:</label>
                              <select name="sala" id="sala" class="form-control" style="border-radius: 3rem">
                                @foreach ($SalasConsultorios as $sala)
                                  <option value="{{$sala->id}}">
                                    Nro: {{$sala->nro_sala}}
                                    - {{$sala->sector->nombre}}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                              <label for="fecha_inicio">Fecha de inicio:</label>
                              <input type="date" class="form-control form-control-user" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                              <label for="cantidad_dias">Cantidad de dias:</label>
                              <input type="number" class="form-control form-control-user" id="cantidad_dias" name="cantidad_dias" value="{{ old('cantidad_dias') }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                              <label for="hora_entrada">Hora de entrada:</label>
                              <input type="time" class="form-control form-control-user" id="hora_entrada" name="hora_entrada"  value="{{ old('hora_entrada') }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                              <label for="hora_salida">Hora de salida:</label>
                              <input type="time" class="form-control form-control-user" id="hora_salida" name="hora_salida" value="{{ old('hora_salida') }}">
                            </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <a href="{{ route('consultorio.index') }}"
                                      class="btn btn-primary btn-user btn-block">
                                      Cancelar
                                  </a>
                              </div>
                          </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

