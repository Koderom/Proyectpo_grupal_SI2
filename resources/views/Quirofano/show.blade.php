@extends('layouts.template')

@section('header')Gestionar quirofano @endsection

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
                            <h1 class="h4 text-gray-900 mb-4">Datos del quirofano</h1>
                        </div>
                        <form class="user" action="#"  method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                              <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="numero_de_sala">Numero de sala:</label>
                                <input type="text" class="form-control form-control-user" id="numero_de_sala" name="numero_de_sala" placeholder="Numero de sala" value="{{ $sala->nro_sala}}">
                              </div>
                              <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="capacidad">Capacidad de personas en la sala:</label>
                                <input type="text" class="form-control form-control-user" id="capacidad" name="capacidad" placeholder="capacidad" value="{{$sala->capacidad}}">
                              </div>
                              <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="capacidad">Sector:</label>
                                <input type="text" class="form-control form-control-user" id="capacidad" name="capacidad" placeholder="capacidad" value="{{$sala->sector->nombre}}">
                              </div>
                          </div>
                          <hr>
                          <h3>Horarios proximos reservados</h3>
                          <table class="table  table-striped table-sm">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">fecha y hora</th>
                                <th scope="col">Duracion aproximada</th>
                                <th scope="col">Procedimiento</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($reservaQuirofanos as $reservarQuirofano)
                                    <tr>
                                        <td> {{$reservarQuirofano->id}}</td>
                                        <td> {{$reservarQuirofano->fecha_hora_entrada}}</td>
                                        <td> {{$reservarQuirofano->cantidad_horas}}</td>
                                        <td> {{$reservarQuirofano->procedimiento}}</td>
                                        <td> {{$reservarQuirofano->paciente->persona->nombre}}
                                             {{$reservarQuirofano->paciente->persona->apellido_paterno}}
                                        </td>
                                        <td>
                                            <a href="{{route('reservarQuirofano.show',['reservarQuirofano'=>$reservarQuirofano])}}" class="btn btn-info btn-sm fas fa-eye cursor-pointer"> ver equipo</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <a href="{{ route('quirofano.index') }}"
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

