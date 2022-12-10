@extends('layouts.template')

@section('header')Documentos archivados @endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    @include('Documentacion.modalCreate')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Archivos registrados</h6>
        </div>
        <div class="card-body">
            <div>
                <form action="">
                    <div class="form-inline">
                        <label for="">Buscar:</label>
                        <input type="text" name="nombre" class="form-control mx-2" placeholder="Nombre">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha de registro</th>
                            <th>Etiquetas</th>
                            <th>Registrado por</th>
                            <th>Paciente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Documentos as $documento)
                          
                            <tr>
                                <td scope="col">{{$documento->id}}</td>
                                <td>{{$documento->nombre}}</td>
                                <td>{{$documento->fecha_registro}}</td>
                                <td>
                                  @foreach ($documento->documentoEtiqueta as $item)
                                      <span class="p-1 badge badge-warning badge-info">{{$item->etiqueta->descripcion}}</span>
                                  @endforeach
                                </td>
                                <td>
                                  {{$documento->user->persona->nombre}}
                                  {{$documento->user->persona->apellido_paterno}}
                                  {{$documento->user->persona->apellido_materno}}
                                </td>
                                <td>
                                  {{$documento->expediente->paciente->persona->nombre}}
                                  {{$documento->expediente->paciente->persona->apellido_paterno}}
                                  {{$documento->expediente->paciente->persona->apellido_materno}}
                                </td>
                                <td>
                                    opciones
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