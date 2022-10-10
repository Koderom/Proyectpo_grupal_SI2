@extends('layouts.template')

@section('header')Seleccionar usuario @endsection

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
                <form  action="{{route('roles.revocar.usuario')}}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="usuario">Usuarios registrados con algun rol</label>
                        <select name="usuario" id="usuario" class="form-control">
                            @foreach ($Usuarios as $usuario)
                                <option value="{{$usuario->id}}">
                                    {{$usuario->persona->nombre}}
                                    {{$usuario->persona->apellido_paterno}}
                                    {{$usuario->persona->apellido_materno}}
                                </option>
                            @endforeach
                        </select>
                    </div class="container">
                        <div class="row">
                            <button type="submit" class="btn btn-primary col-3">Siguiente</button>
                            <a href="{{ route('roles.index') }}"
                                class="btn btn-danger btn-user btn-block col-3">
                                Cancelar
                            </a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection