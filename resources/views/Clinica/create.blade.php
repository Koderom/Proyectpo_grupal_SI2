@extends('layouts.template')

@section('header')Perfil  de la Clinica @endsection

@section('content')
@include('components.flash_alerts')
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-body bg-red">
			<h2>Datos de la clinica</h2>
			<hr>
			<div class="container">
        <div class="row">
          <div class="col col-xl-6" id=formulario>
            <form action="{{route('clinica.store')}}" enctype="multipart/form-data" method="POST">
              @csrf
              @method('post')
              <h3>Configuración</h3>
              <div class="form-group">
                <label for="nombre">Nombre del establecimiento: </label>
                <input type="text" id="nombre" name="nombre" class="form-control">
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="archivo">Logo del establecimiento   :</label>
                  <input type="file" name="logo" id="archivo">
                </div>
              </div>
              <button type="submit" class="btn btn-primary my-3 ">Guardar cambios</button>
            </form>
          </div>
          <div class="col col-xl-6 p-3">
            <label>Previsualizacion del archivo:</label>
            <div>
              <iframe class="embed-responsive-item" id="previsualizacion"  scrolling="no" width="560" height="400" frameborder="0"></iframe>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>  
</div>
<script>
  const archivo = document.querySelector('#archivo');;
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
  window.addEventListener('DOMContentLoaded', (event) => {
    cargarPrevisualizacion();
  });
  archivo.addEventListener('change', cargarPrevisualizacion);
</script>
@endsection