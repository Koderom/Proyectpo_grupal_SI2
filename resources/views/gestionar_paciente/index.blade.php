@extends('layouts.template')

@section('header')Paciente @endsection

@section('content')
@include('components.flash_alerts')
                <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    
    <p class="mb-4"></p>       
    <a href="{{asset('/paciente.create')}}" class="btn btn-success btn-icon-split">
        <span class="text">Registrar Paciente</span>
    </a>
    <div class="my-2"></div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Paciente</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nrº</th>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nrº</th>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i = 1;

                        @endphp

                        @foreach ($pacientes as $paciente)
                            
                            <tr>
                                <td>{{ $i++ }}</td>
                                <th>{{$paciente->persona->ci}}</th>
                                <th>{{$paciente->persona->nombre}}</th>
                                <th>{{$paciente->persona->apellido_paterno . " " . $paciente->persona->apellido_materno}}</th>
                                <th>{{$paciente->persona->User->name}}</th>
                                <td>
                                    <div class="d-flex">
                                        <form action="{{route('paciente.destroy',$paciente->persona_id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                            <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                                onclick="return confirm('¿ESTA SEGURO QUE DESEA ELIMINAR?')" value="Borrar">
                                            </button>
                                            
                                        </form>
                                        <div class="dropdown mr-1 mx-1">
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-ex>
                                                Opciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{route('paciente.show',$paciente->persona_id)}}" class="dropdown-item btn btn-info btn-sm cursor-pointer"><i class="fas fa-eye "></i> Ver mas</a>
                                                <a href="{{route('paciente.edit',$paciente->persona_id)}}"class="dropdown-item  btn btn-primary btn-sm cursor-pointer"><i class="fas fa-edit"></i> Editar</a>
                                                <a href="{{route('expediente.paciente.index',['paciente'=>$paciente])}}" class=" dropdown-item btn btn-secondary btn-sm cursor-pointer"><i class="fas fa-file-medical-alt"></i> Ver expediente medico</a>
                                            </div>
                                        </div>
                                    </div>
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