@extends('layouts.template')

@section('header')Gestionar internación @endsection

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 3rem">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrar Sala</h1>
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
                        <form class="user" action="{{ route('internacion.store') }}"  method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                              <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="numero_de_sala">Numero de sala:</label>
                                <input type="text" class="form-control form-control-user" id="numero_de_sala" name="numero_de_sala" placeholder="Numero de sala" value="{{ old('numero_de_sala') }}">
                              </div>
                              <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="capacidad">Capacidad:</label>
                                <input type="text" class="form-control form-control-user" id="capacidad" name="capacidad" placeholder="capacidad" value="{{ old('capacidad') }}">
                              </div>
                              <div class="col-sm-4 mb-3 mb-sm-0" id="cantidad_camas">
                                <label for="cantidad_camas">Cantidad de camas:</label>
                                <input type="number" class="form-control form-control-user" id="cantidad_camas" name="cantidad_camas" placeholder="cantidad de camas">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label for="sector">Seleccionar sector:</label>
                              <select name="sector" id="sector" class="form-control" style="border-radius: 3rem">
                                @foreach ($Sectores as $sector)
                                  <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0" id="tipo_internacion">
                                <label for="tipo_internacion">Seleccionar tipo de internacion:</label>
                                <select name="tipo_internacion" id="tipo_internacion" class="form-control" style="border-radius: 3rem">
                                    @foreach ($TiposInternacion as $tipoInternacion)
                                        <option value="{{$tipoInternacion->id}}">{{$tipoInternacion->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                              </div>
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

