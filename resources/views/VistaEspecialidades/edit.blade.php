@extends('layouts.template')

@section('header')
    Editar Especialidad
@endsection

@section('content')
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <h1>Registra nuevo Especialidad</h1>
                            {{-- {{ csrf_field() }}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                            <form class="user" action="{{ route('especialidad.update',$editar->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col-12 ">
                                            <label for="descripcion">Ingrese una descripcion:</label>
                                            <input class="form-control form-control-user" type="text" name="especialidad"
                                                id="descripcion" value="{{$editar->nombre}}">
                                                <input type="text" name="id" value="{{$editar->id}}" hidden>
                                        </div>
                                    </div>
                                    <div class="form-group row m-5">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="submit" class="btn btn-facebook btn-user btn-block"
                                                value="Aceptar">
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <a href="{{ route('especialidad.index') }}"
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
