@extends('layouts.template')

@section('header')
Expediente Clinico de:  
  <strong>
    {{$paciente->persona->nombre}}
    {{$paciente->persona->apellido_paterno}}
    {{$paciente->persona->apellido_materno}}
  </strong>
@endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- DataTales Example -->
  <a href="{{route('historialClinico.create',['paciente'=>$paciente])}}" class="btn btn-info btn-sm align-self-end">Registrar Historia Clinica</a>
  <a href="{{route('documentacion.paciente.create',['paciente'=>$paciente])}}" class="btn btn-info btn-sm align-self-end">Agregar Archivo</a>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Archivos registrados</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Nº</th>
              <th scope="col">Nombre</th>
              <th scope="col">Registrado por</th>
              <th scope="col">fecha de registro</th>
              <th scope="col">Etiquetas</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          @foreach ($expediente->documentacion as $documentacion)
              <tr>
                <td scope="row">{{$documentacion->id}}</td>
                <td>{{$documentacion->nombre}}</td>
                <td>
                  {{$documentacion->user->persona->nombre}}
                  {{$documentacion->user->persona->apellido_paterno}}
                  {{$documentacion->user->persona->apellido_materno}}
                </td>
                <td>{{$documentacion->fecha_registro}}</td>
                <td>
                  @foreach ($documentacion->documentoEtiqueta as $item)
                      <span class="p-1 badge badge-warning badge-info">{{$item->etiqueta->descripcion}}</span>
                  @endforeach
                </td>
                <td>
                  <a href="{{Storage::url($documentacion->path)}}" target="_black">ver</a>
                  <form action="{{route('documentacion.destroy',['documentacion'=>$documentacion])}}"></form>
                </td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->    
@endsection