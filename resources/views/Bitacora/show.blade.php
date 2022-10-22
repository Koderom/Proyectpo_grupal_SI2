@extends('layouts.template')

@section('header')Ver Bitacora @endsection

@section('content')
<div class="container-fluid">
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary">Datos de la bitacora</h6> --}}
        </div>

        <div class="card-body">
            <form>
                <div class="form-row">
                    <h3 class="col-md-12"><strong>Datos de la Bitacora</strong></h3>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">ID:</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->id}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">Objeto:</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->objeto}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">ID de entidad:</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->entidad_id}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">Entidad Descripcion</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->entidad_descripcion}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">Accion</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->verbo}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">Fecha y hora de registro</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->fecha_hora}}" readonly>
                    </div>
                    <h3 class="col-md-12"><strong>Datos del Autor</strong></h3>
                    
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">ID de usuario</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->user_id}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">Nombre de usuario</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->user_name}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">ID de persona</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->persona_id}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_bitacora">Nombre de persona</label>
                        <input type="text" class="form-control" id="inputEmail4" value="{{$bitacora->nombre_completo}}" readonly>
                    </div>
                    
                </div>
                <a href="{{route('bitacora.index')}}" class="btn btn-primary">volver</a>
            </form>
        </div>
    </div>    
</div>
@endsection