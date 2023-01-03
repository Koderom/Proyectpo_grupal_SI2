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
					<a class="btn btn-secondary" href="{{route('clinica.create')}}"><i class="fas fa-cog"></i> Configurar</a>	
				</div>
			</div>
		</div>
	</div>  
</div>
@endsection