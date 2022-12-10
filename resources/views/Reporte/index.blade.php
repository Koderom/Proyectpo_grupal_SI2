@extends('layouts.template')

@section('header')Reportes @endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
      <h6 class="m-0 font-weight-bold text-primary">Reportes</h6>
    </div>
    <div class="card-body">
      <div>
        <form action="{{route('reporte.create')}}" method="POST">
          @csrf
          @method('post')
          <div class="form-row">
            <div class="form-group">
              <label for="tabla">Tablas disponibles:</label>
              <select name="tabla" id="tabla" class="form-control">
                @foreach ($Tablas as $tabla)
                  <option value="{{$tabla}}">{{$tabla}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Generar roporte</button>
          
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->    
@endsection