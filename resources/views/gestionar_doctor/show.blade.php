@extends('layouts.template')

@section('header')Medico @endsection

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Detalle Medico</h1>
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
                            <!-- formulario para editar-->
                            <form class="user" action="#"  method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                 {{-- {@dd($persona->user);    --}}
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        name="ci" placeholder="Ci" value="{{ old('nombre',$doctor->persona->ci) }}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            name="nombre" placeholder="Nombres" value="{{ old('nombre',$doctor->persona->nombre) }}" readonly>
                                    </div>   
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            name="apellido_paterno" placeholder="Apellido Paterno" value="{{ old('apellido_paterno',$doctor->persona->apellido_paterno) }}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            name="apellido_materno" placeholder="Apellido Materno" value="{{ old('apellido_materno',$doctor->persona->apellido_materno) }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Género:
                                        <div class="form-check">
                                            @if($doctor->persona->sexo[0]=='M')
                                            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="{{'M'}}" checked disabled>
                                            <label class="form-check-label" for="flexRadioDefault1">Masculino</label>
                                            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault2" value="{{'F'}}" disabled>
                                            <label class="form-check-label" for="flexRadioDefault2">Femenino</label>
                                            @endif
                                            @if($doctor->persona->sexo[0]=='F')
                                            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="{{'M'}}" disable>
                                            <label class="form-check-label" for="flexRadioDefault1">Masculino</label>
                                            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault2" value="{{'F'}}"checked disable>
                                            <label class="form-check-label" for="flexRadioDefault2">Femenino</label>
                                            @endif
                                          </div>
                                          
                                        </div>
                                        <div class="col-sm-6">
                                             {{-- <input type="text" class="form-control form-control-user" id="exampleInputCargo"
                                            name="Especialidad" placeholder="Especialidad" value="{{ old('cargo') }}">  --}}
                                            <select name="especialidad_id" id=""> 
                                                @foreach ($Especialidades as $especialidad)
                                                   
                                                    @if ($doctor->especialidad_id == $especialidad->id)
                                                    <option value="{{$especialidad->id}}" selected>{{$especialidad->nombre}}</option >
                                                    @else
                                                    <option value="{{$especialidad->id}}" >{{$especialidad->nombre}} </option >   
                                                    @endif

                                                @endforeach 
                                                
                                            </select > 
                                            
                                        </div>
                                    
                                </div>
                                 <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" class="form-control form-control-user" id="exampleInputEmail"
                                        name="fecha_nacimiento" placeholder="Fecha de nacimiento" value="{{ old('fecha_naci',$doctor->persona->fecha_nacimiento ) }}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                        name="edad" placeholder="Edad" value="{{ old('edad',$doctor->persona->edad )}}" readonly>
                                        
                                        </div> 
                                    
                                 </div> 
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="tel" class="form-control form-control-user" id="exampleInputEmail"
                                        name="telefono" placeholder="Telefono" value="{{ old('telefono',$doctor->persona->telefono )}}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                            name="direccion" placeholder="Direccion" value="{{ old('direccion',$doctor->persona->direccion )}}" readonly>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    name="email" placeholder="Correo" value="{{ old('correo',$doctor->persona->user->email) }}" readonly>
                                </div> 

                                <div class="form-group">
                                    {{-- hidden --}}
                                    <input type="hidden" class="form-control form-control-user" id="exampleInputEmail"
                                        name="tipo" value="A">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        name="name" placeholder="Usuario" value="{{ old('usuario',$doctor->persona->user->name) }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="exampleInputEmail"
                                        name="password" placeholder="password" value="{{ old('password',$doctor->persona->user->password) }}" readonly>
                                </div>
                                    <div class="form-group row">
                                    <div class="mb-3 mb-sm-0 centrar-gp">
                                        <a href="{{ route('doctores.index') }}"
                                            class="btn btn-primary btn-user btn-block">
                                            Volver
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
