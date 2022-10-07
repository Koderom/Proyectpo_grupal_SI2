@extends('layouts.template')

@section('header')Crear nuevo Rol @endsection

@section('content')
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5" >
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <h1>Crear nuevo Rol</h1>
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
                            <form class="user" action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                
                                <div class="container">
                                    <label for="rol_nombre">Introducir un nombre para el rol:</label>
                                    <input class="form-control form-control-user"  type="text" name="rol_nombre" id="rol_nombre" value="{{old('rol_nombre')}}"><br>
                                </div>
                                <div class="container">
                                    <h6>Seleccionar permisos</h6>
                                
                                    <div class="row row-cols-3">
                                        @foreach ($Permisos as $permiso)
                                            <div >
                                                <input id="permiso.{{$permiso}}"class="form-check-input "  type="checkbox" name="permisos[]" value="{{$permiso->id}}">
                                                <label for="permiso.{{$permiso}}" class="form-check-label">{{$permiso->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    
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