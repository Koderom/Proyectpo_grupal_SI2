@extends('layouts.template')

@section('header')Sector @endsection

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrar Sector</h1>
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
                        <form class="user" action="{{ route('sector.store') }}"  method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="nombre_de_sector">Nombre del sector:</label>
                                <input type="text" class="form-control form-control-user" id="nombre_de_sector" name="nombre_de_sector" placeholder="Nombre de se sector" value="{{ old('nombre_de_sector') }}">
                              </div>
                              <div class="col-sm-6">
                                <label for="piso_de_ubicacion">Piso donde se encuentra ubicado:</label>
                                <input type="text" class="form-control form-control-user" id="piso_de_ubicacion" name="piso_de_ubicacion" placeholder="Nro de piso" value="{{ old('piso_de_ubicacion') }}">
                              </div>   
                          </div>        
                          <div class="form-group row">
                              <label for="funcionalidad_del_sector">Funcionalidad del sector:</label>
                              <input type="text" class="form-control form-control-user" id="funcionalidad_del_sector" name="funcionalidad_del_sector" placeholder="Funcionalidad del sector" value="{{ old('funcionalidad_del_sector') }}">
                          </div>                        
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <a href="{{ route('sector.index') }}"
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
