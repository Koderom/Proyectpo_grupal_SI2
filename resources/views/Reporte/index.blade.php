@extends('layouts.template')

@section('header')Reportes personalizados @endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
      <h6 class="m-0 font-weight-bold text-primary">Crear Reporte</h6>
    </div>
    <div class="card-body">
      <div>
        <form action="{{route('reporte.create')}}" method="POST">
          @csrf
          @method('post')
          <div class="form-row">
            <div class="form-inline">
              <label for="tabla">Tablas disponibles:</label>
              <select name="tabla" id="tabla" class="form-control mx-2">
                @foreach ($Tablas as $tabla)
                  <option value="{{$tabla}}">{{$tabla}}</option>
                @endforeach
              </select>
              <div>
                <button type="submit" class="btn btn-primary btn-sm">Cargar</button>
              </div>
            </div>
          </div>
        </form>
        @isset($tablaContenido)
          <div class="border rounded p-3 my-3">
            <h3>Tabla: {{$tablaSeleccionada}}</h3>
            <form action="{{route('reporte.pdfGenerate')}}" id="generarPDF" method="POST">
              @method('post')
              @csrf
              <input type="text" name="tabla" hidden value="{{$tablaSeleccionada}}">
              <div class="form-inline my-3">
                <label for="">Titulo del reporte</label>
                <input type="text" name="titulo" class="form-control mx-2">
              </div>
              <div class="form-group">
                <label for="">Parrafo de comentario:</label>
                <input type="textarea" class="form-control" name="comentario">
              </div>
              <div class="form-inline my-3">
                <label for="">Cantidad de filas a mostrar</label>
                <input type="text" name="filas" id="filas" class="form-control mx-2" value="{{$tablaContenido->count()}}">
                <small>cantidad maxima a mostrar: {{$tablaContenido->count()}}</small>
              </div>
              <div class="form-inline my-3">
                <label for="">Ordenar por:</label>
                <select name="ordenarPor" id="ordenarPor" class="form-control mx-2">
                  @foreach ($Columnas as $columna)
                    <option value="{{$columna}}">{{$columna}}</option>
                  @endforeach
                </select>
                <select name="ordenar" id="ordenar" class="form-control">
                  <option value="asc">Ascendente</option>
                  <option value="desc">Descendente</option>
                </select>
              </div>
              <div class="form-group my-3">
                <label for="">Mostrar columnas:</label>
                <div class="row d-flex p-3">
                  @foreach ($Columnas as $columna)
                  <div class="col-auto mx-2">
                    <input type="checkbox" name="columnas[]" id="columna_{{$columna}}" value="{{$columna}}" checked>
                    <label for="columna_{{$columna}}">{{$columna}}</label>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="form-inline">
                <label for="">Filtrar datos por:</label>
                <select name="filtrarPor" id="filtrarPor" class="form-control mx-2">
                  @foreach ($Columnas as $columna)
                    <option value="{{$columna}}">{{$columna}}</option>
                  @endforeach
                </select>
                <select name="filtrarOP" id="filtrarOP" class="form-control mx-2">
                  <option value="=">Igua a</option>
                  <option value="<>">Diferente de</option>
                  <option value=">">Mayor a</option>
                  <option value="<">Menor a</option>
                  <option value="like">Coinsidencia de texto</option>
                </select>
                <input type="text" name="filtrarVal" class="form-control mx-2">
              </div>
              <div class="py-3">
                <button type="submit" class="btn btn-sm btn-success" form="generarPDF">Generar PDF</button>
              </div>
            </form>
          </div>        
         @endisset
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->    
@endsection