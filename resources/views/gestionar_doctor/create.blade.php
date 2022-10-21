@extends('layouts.template')

@section('header')Registrar nuevo Doctor @endsection

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrar Doctor</h1>
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
                            <!-- personas.create=stores-->
                            <form class="user" action="{{Route('doctores.store')}}"  method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        name="ci" placeholder="Ci" value="{{ old('ci') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            name="nombre" placeholder="Nombres" value="{{ old('nombre') }}">
                                    </div>   
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            name="apellido_paterno" placeholder="Apellido Paterno" value="{{ old('apellido_paterno') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            name="apellido_materno" placeholder="Apellido Materno" value="{{ old('apellido_materno') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Género:
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="{{'M'}}" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                              Masculino
                                            </label>
                                          <!--/div>
                                          <div class="form-check"-->
                                            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault2" value="{{'F'}}">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                              Femenino
                                            </label>
                                          </div>
                                          
                                        </div>
                                        <div class="col-sm-6">
                                            {{-- <input type="text" class="form-control form-control-user" id="exampleInputCargo"
                                            name="Especialidad" placeholder="Especialidad" value="{{ old('cargo') }}"> --}}
                                            <select name="especialidad_id" id=""> 
                                                 <option value="">-- Especialidad -- </option>
                                                @foreach ($especialidad as $cargo)
                                                    <option value="{{$cargo->id}}">
                                                        {{$cargo->nombre}}
                                                    </option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    
                                </div>
                                 <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" class="form-control form-control-user" id="exampleInputEmail"
                                        name="fecha_nacimiento" placeholder="Fecha de nacimiento" value="{{ old('fecha_naci') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                        name="edad" placeholder="Edad" value="{{ old('edad') }}">
                                        
                                        </div> 
                                    
                                 </div> 
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="tel" class="form-control form-control-user" id="exampleInputEmail"
                                        name="telefono" placeholder="Telefono" value="{{ old('telefono') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                            name="direccion" placeholder="Direccion" value="{{ old('direccion') }}">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    name="email" placeholder="Correo" value="{{ old('correo') }}">
                                </div> 

                                <div class="form-group">
                                    {{-- hidden --}}
                                    <input type="hidden" class="form-control form-control-user" id="exampleInputEmail"
                                        name="tipo" value="A">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        name="name" placeholder="Usuario" value="{{ old('usuario') }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="exampleInputEmail"
                                        name="password" placeholder="password" value="{{ old('password') }}">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a href="{{ route('home') }}"
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
