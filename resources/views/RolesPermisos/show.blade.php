@extends('layouts.template')

@section('header') Permisos de {{$rol->name}}@endsection

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5" >
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <div class="p-5">
                        
                        <div class="container">
                            <h2>Nombre de rol: {{$rol->name}}</h2>
                            <h2>Permisos habilitados</h2>
                            <div class="row row-cols-3">
                                <ul>
                                    
                                    @foreach ($Permisos as $permiso)
                                        <li>{{$permiso->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="form-group row m-5" >
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <a href="{{ route('roles.index') }}"
                                        class="btn btn-primary btn-user btn-block">
                                        Volver
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection