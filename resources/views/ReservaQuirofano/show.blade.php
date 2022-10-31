@extends('layouts.template')

@section('header')Gestionar Quirofano @endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    
    <p class="mb-4"></p>       
    @include('ReservaQuirofano.agregarEquipoModal')
    <div class="my-2"></div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Equipo medicos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered m-2" id="dataTable" width="100%" cellspacing="0" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Especialidad</th>
                            <th>Funcion</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Especialidad</th>
                            <th>Funcion</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($DoctorQuirofanos as $doctorQuirofano)
                          
                            <tr>
                                <td>{{$doctorQuirofano->doctor->id}}</td>
                                <td>{{$doctorQuirofano->doctor->persona->nombre}}</td>
                                <td>
                                    {{$doctorQuirofano->doctor->persona->apellido_paterno}}
                                    {{$doctorQuirofano->doctor->persona->apellido_materno}}
                                </td>
                                <td>{{$doctorQuirofano->doctor->especialidad->nombre}}</td>
                                <td>{{$doctorQuirofano->funcion}}</td>
                                <td>
                                    <form action="{{route('reservarQuirofano.eliminar',['doctorQuirofano'=>$doctorQuirofano])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                            onclick="return confirm('¿ESTA SEGURO QUE DESEA ELIMINAR?')" value="Borrar">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{route('quirofano.show',['sala'=>$reservarQuirofano->quirofano->sala->id])}}"
                class="col-sm-2 btn btn-primary btn-user btn-block">
                volver
            </a>  
        </div>    
    </div>
</div>
<!-- /.container-fluid -->    
@endsection