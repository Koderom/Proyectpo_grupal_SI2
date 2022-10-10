@extends('layouts.template')

@section('header')Seleccionar doctor @endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-5 bg-white" style="border-radius: 1rem">
            <div class="card-body ">
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
                <form class="user" action="{{route('roles.revocar.store')}}" method="POST">
                    @csrf
                    <div class="container">
                        <h3>Editar los roles para el usuario: 
                            <strong>
                                {{$usuario->persona->nombre}}
                                {{$usuario->persona->apellido_paterno}}
                                {{$usuario->persona->apellido_materno}}
                            </strong>
                        </h3>
                        <h6>Seleccionar roles a mantener</h6>                                
                        <div class="col">
                            @foreach ($Roles as $rol)
                                <div>
                                    <input id="permiso.{{$rol}}"class="form-check-input "  type="checkbox" name="roles[]" value="{{$rol->id}}" checked>
                                    <label for="permiso.{{$rol}}" class="form-check-label">{{$rol->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="usuario" value="{{$usuario->id}}">
                    </div>
                    
                    <div class="form-group row m-5" >
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <a href="{{ route('roles.index') }}"
                                class="btn btn-primary btn-user btn-block">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection