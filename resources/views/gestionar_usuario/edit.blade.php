@extends('layouts.template')

@section('header')Usuario @endsection

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            @if($persona->tipo[0]=='A')
                            <a href="{{route('administrativo.edit',$persona->user->persona_id)}}" class="btn btn-success btn-icon-split">
                                <span class="text">Modificar Administrativo</span>
                            </a>
                            @endif
                            @if($persona->tipo[0]=='P')
                            <a href="{{route('paciente.edit',$persona->user->persona_id)}}" class="btn btn-success btn-icon-split">
                                <span class="text">Modificar Paciente</span>
                            </a>
                            @endif
                            @if($persona->tipo[0]=='D')
                            <a href="{{route('paciente.edit',$persona->user->persona_id)}}" class="btn btn-success btn-icon-split">
                                <span class="text">Modificar Doctor</span>
                            </a>
                            @endif
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Modificar Usuario</h1>
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
                            
                            <form class="user" action="{{ route('usuario.update',[$persona->id]) }}"  method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        name="ci" placeholder="Ci" value="{{$persona->ci}}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            name="nombre" placeholder="Nombres" value="{{$persona->nombre." ".$persona->apellido_paterno." ".$persona->apellido_materno}}" readonly>
                                    </div>   
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        name="name" placeholder="Usuario" value="{{ $persona->user->name }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="exampleInputEmail"
                                        name="password" placeholder="password" value="{{ $persona->user->password }}">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a href="{{ route('usuario.index') }}"
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
