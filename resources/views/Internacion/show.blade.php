@extends('layouts.template')

@section('header')Gestionar sala de Internacion @endsection

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
                            <h1 class="h4 text-gray-900 mb-4">Datos de la sala Nro: {{$sala->nro_sala}}</h1>
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
                        <form class="user" action="{{ route('sala.store') }}"  method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="numero_de_sala">Nurmero de sala:</label>
                                <input type="text" class="form-control form-control-user" id="numero_de_sala" name="numero_de_sala" placeholder="Numero de sala" value="{{$sala->nro_sala}}" readonly>
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="capacidad">Capacidad maxima:</label>
                                <input type="text" class="form-control form-control-user" id="capacidad" name="capacidad" placeholder="capacidad" value="{{$sala->capacidad}} Personas" readonly>
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label for="numero_de_sala">Tipo de internacion:</label>
                              <input type="text" class="form-control form-control-user" id="numero_de_sala" name="numero_de_sala" placeholder="Numero de sala" value="{{$sala->internacion->tipoInternacion->descripcion}}" readonly>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label for="capacidad">Total de camas:</label>
                              <input type="text" class="form-control form-control-user" id="capacidad" name="capacidad" placeholder="capacidad" value="{{$sala->internacion->cama->count()}} Camas" readonly>
                            </div>
                          </div>
                          <hr>
                          <h3>Pacientes internados</h3>
                          <table class="table  table-striped table-sm">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido paternno </th>
                                <th scope="col">Apellido materno </th>
                                <th scope="col">fecha internacion</th>
                                <th scope="col">Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($Pacientes as $paciente)
                                    <tr>
                                        <td> {{$paciente->id}}</td>
                                        <td> {{$paciente->persona->nombre}}</td>
                                        <td> {{$paciente->persona->apellido_paterno}}</td>
                                        <td> {{$paciente->persona->apellido_materno}}</td>
                                        <td> {{$paciente->fecha_ingreso}}</td>
                                        <td>
                                            <a href="{{route('internacion.paciente.retirar',['paciente'=>$paciente])}}" class="btn btn-info btn-sm cursor-pointer"> retirar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                          <div class="form-group row my-4">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <a href="{{ route('internacion.index') }}"
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

