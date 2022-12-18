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
				@if ($clinica != null)
					<div class="row">
						<strong>Nombre del establecimiento :</strong> {{$clinica->nombre}}
					</div>
					<div class="row">
						<strong class="col-12">Logo del establecimiento:</strong>
						<img class="py-3" src="{{ Storage::url('imagenes/logo/XgQlOwFHgorud3i3pNPNj2rxpR5KgJNVtKrx7GpH.jpg') }}" alt="logo" width="300">
					</div>		
				@endif
				<div class="row py-3">
					<button class="btn btn-secondary" id="btn_conf"><i class="fas fa-cog"></i> Configurar</button>	
				</div>
				<div class="row-12" id=formulario>
					<form action="{{route('clinica.store')}}" enctype="multipart/form-data" method="POST">
						@csrf
						@method('post')
						<h3>Configuración</h3>
						<div class="form-group">
							<label for="nombre">Nombre del establecimiento: </label>
							<input type="text" id="nombre" name="nombre" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Logo del establecimiento</label>
							<div class="custom-file">
								<input type="file" name="logo" id="logo" class="custom-file-input">
								<label for="logo" class="custom-file-label" data-browse="Buscar">Seleccionar archivo</label>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Guardar cambios</button>
					</form>
				</div>
			</div>
		</div>
	</div>  
</div>
<script>
	const btnConf = document.querySelector('#btn_conf');
	function btnConfHandle(event){
		const formulario = document.querySelector('#formulario');
		if(formulario.style.display != 'none'){
			document.querySelector('#formulario').style.display = 'none';
		}else{
			document.querySelector('#formulario').style.display = 'block';	
		}
	}
	btnConf.addEventListener('click', btnConfHandle);
</script>
@endsection