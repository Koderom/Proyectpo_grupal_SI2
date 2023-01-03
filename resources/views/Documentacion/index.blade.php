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
                        <label>Filtrar por:</label>
                        <select name="filtrar" id="" class="form-control m-2">
                            @foreach ($Filtros as $filtro)
                                @if ($filtro == $filtrado_por)
                                    <option value="{{$filtro}}" selected>{{$filtro}}</option>        
                                @else
                                    <option value="{{$filtro}}">{{$filtro}}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="text" name="texto_buscar" class="form-control m-2" placeholder="Buscar..." value="{{old('texto_buscar')}}">
                        <button class="btn btn-sm btn-primary mx-2 my-1"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cod expediente</th>
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
                                <td>{{$documento->expediente->codigo_registro}}</td>
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
                                    <div class="d-flex">
                                        <a class="btn btn-sm btn-success" href="{{Storage::url($documento->path)}}" target="_black"><i class="fas fa-download"></i></a>
                                        <form action="{{route('documentacion.destroy',['documentacion'=>$documento])}}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger mx-1"><i class="fas fa-trash"></i></button>
                                        </form>
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