@extends('layouts.template')

@section('header')Asignar Roles a Usuario @endsection

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5" >
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <div class="p-5">
                        <h1>Asignar Roles a Usuarios</h1>
                        <form action="{{route('roles.store-asignar-rol')}}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="inputGroupSelect01">Usuarios: </label>
                                </div>
                                <select name="usuario" id="usuario" class="custom-select">
                                    @foreach ($Usuarios as $usuario)
                                    <option value="{{$usuario->id}}">
                                        {{$usuario->persona->nombre}}
                                        {{$usuario->persona->apellido_paterno}}
                                        {{$usuario->persona->apellido_materno}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="inputGroupSelect01">Roles: </label>
                                </div>
                                <select name="rol" id="rol" class="custom-select">
                                    @foreach ($Roles as $rol)
                                        <option value="{{$rol->id}}">{{$rol->name}}</option>
                                    @endforeach
                                </select>
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
        </div>
    </div>
</div>    
@endsection