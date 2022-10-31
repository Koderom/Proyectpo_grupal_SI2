@extends('layouts.template')

@section('header')Gestionar consultorio @endsection

@section('content')
@include('components.flash_alerts')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 3rem">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Ver datos de la sala de consultorio</h1>
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
                        <div class="user">
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="numero_de_sala">Numero de sala:</label>
                                <input type="text" class="form-control form-control-user" id="numero_de_sala" name="numero_de_sala" placeholder="Numero de sala" value="{{$sala->nro_sala }}" readonly style="border-radius: 3rem">
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="capacidad">Capacidad maxima de personas en la sala:</label>
                                <input type="text" class="form-control form-control-user" id="capacidad" name="capacidad" placeholder="capacidad" value="{{$sala->capacidad}}"readonly style="border-radius: 3rem">
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="capacidad">Sector:</label>
                                <input type="text" class="form-control form-control-user" id="capacidad" name="capacidad" placeholder="capacidad" value="{{$sala->sector->nombre}}"readonly style="border-radius: 3rem">
                              </div>
                          </div>
                          <div class="row my-5">
                            <h3>Asiganaciones de la sala nª {{$sala->nro_sala}}</h3>
                            <table class="table table-sm my-2">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Fecha de inicio</th>
                                        <th scope="col">Hora de entrada</th>
                                        <th scope="col">Hora de salida</th>
                                        <th scope="col">Cantidad de dias</th>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Asignaciones as $asignacion)
                                        <tr>
                                            <td>{{$asignacion->id}}</td>
                                            <td>{{$asignacion->fecha_inicio}}</td>
                                            <td>{{$asignacion->hora_entrada}}</td>
                                            <td>{{$asignacion->hora_salida}}</td>
                                            <td>{{$asignacion->cantidad_dias}}</td>
                                            <td>{{$asignacion->doctor->persona->nombre}}</td>
                                            <td>
                                                <form action="{{route('asignacionConsultorio.destroy',['asignacionConsultorio'=>$asignacion])}}" method="post" id="formulario-destroy">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer" form="formulario-destroy" 
                                                        onclick="return confirm('¿ESTA SEGURO DE  BORRAR?')" value="Borrar">
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <a href="{{ route('consultorio.index') }}" style="border-radius: 3rem"
                                      class="btn btn-primary btn-user btn-block">
                                      Cancelar
                                  </a>
                              </div>
                          </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

