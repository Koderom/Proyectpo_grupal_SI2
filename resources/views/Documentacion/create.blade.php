@extends('layouts.template')

@section('header')
Expediente Clinico:
<strong>
  {{$paciente->persona->nombre}}
  {{$paciente->persona->apellido_paterno}}
  {{$paciente->persona->apellido_materno}}
</strong>
@endsection

@section('content')
<div class="container">
  <div class="card o-hidden border-0 shadow-lg" style="border-radius: 3rem">
    <div class="card-body">
      <h3>Registra nuevo archivo</h3>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col col-xl-5">
            <form class="user"id="formulario" action="{{ route('documentacion.paciente.store',['paciente'=>$paciente]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="archivo_nombre">Nombre del archivo:</label>
                <input type="text" name="archivo_nombre" id="archivo_nombre" class="form-control">
              </div>
              <div class="form-group">
                <label for="archivo">Seleccione un archivo:</label>
                <input type="file" name="archivo" id="archivo">
              </div>
              <div class="form-group">
                <label>Etiquetas:</label>
                <div class="my-2">
                  @foreach ($Etiquetas as $etiqueta)
                      <label for="etiqueta_{{$etiqueta->descripcion}}"" class="p-1 badge badge-pill badge-warning">
                        {{$etiqueta->descripcion}}
                        <input type="checkbox" id="etiqueta_{{$etiqueta->descripcion}}" name="etiquetas[]" value="{{$etiqueta->id}}">
                      </label>
                  @endforeach
                </div>
                <label for="">Añadir etiquetas</label>
                <div class="form-inline">
                  <input type="text" class="form-control mx-1" id="tag-text">
                  <button type="button" class="bnt btn-sm btn-info" id="btn-addTag">añadir</button>
                </div>
                <div id="tag-container" class="my-2"></div>
              </div>
            </form>
          </div>
          <div class="col col-xl-7 p-3">
            <label>Previsualizacion del archivo:</label>
            <div>
              <iframe class="embed-responsive-item" id="previsualizacion"  scrolling="no" width="560" height="400" frameborder="0"></iframe>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input class="btn btn-primary" type="submit" form="formulario">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const archivo = document.querySelector('#archivo');
  const btnAddTag = document.querySelector('#btn-addTag');
  function cargarPrevisualizacion(){
    const previsualizado = document.querySelector('#previsualizacion');
    const archivosSubidos = archivo.files;
    if(!archivosSubidos || !archivosSubidos.length){
      previsualizado.src = "";
      return;
    }
    const primerArchivo = archivosSubidos[0];
    const objectURL = URL.createObjectURL(primerArchivo);
    previsualizado.src = objectURL;
  }
  function addTag(){
    let texto = document.querySelector('#tag-text').value;
    const tagContainer = document.querySelector('#tag-container');
    let temp = `
    <label for="etiqueta_{{$etiqueta->descripcion}}"" class="p-2 badge badge-pill badge-warning">
      ${texto}
      <input type="checkbox" name="tagAdded[]" value="${texto}" checked hidden>
    </label>
    `;
    tagContainer.innerHTML += temp;
    document.querySelector('#tag-text').value = "";
  }
  window.addEventListener('DOMContentLoaded', (event) => {
    cargarPrevisualizacion();
  });
  archivo.addEventListener('change', cargarPrevisualizacion);
  btnAddTag.addEventListener('click', addTag);
</script>
@endsection