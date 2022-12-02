@extends('layouts.template')

@section('header')Expediente Clinido de:  <strong>{{$paciente->persona->nombre}}</strong>@endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- DataTales Example -->
  
  <a href="#" class="btn btn-success btn-sm">Historia clinica</a>
  <a href="#" class="btn btn-success btn-sm">Consultas</a>
  <a href="#" class="btn btn-success btn-sm">Documentos clinicos</a>

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
              <th scope="col">Descripcion</th>
              <th scope="col">Fecha</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>informacion que cura</td>
              <td>informacion que cura</td>
              <td>informacion que cura</td>
            </tr>
          </tbody>
        </table>
      </div>
      <a href="{{route('historialClinico.create',['paciente'=>$paciente])}}" class="btn btn-info btn-sm align-self-end">Actualizar historial</a>
    </div>
  </div>
</div>
<!-- /.container-fluid -->    
@endsection