@extends('layouts.template')

@section('header')Roles y permisos @endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de permisos disponibles</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>Descripcion</th>
                    </tr>
                    @foreach ($Permisos as $permiso)
                    <tr>
                        <td>{{$permiso->id}}</td>
                        <td>{{$permiso->name}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>           
    </div>
</div>
<div class="container-fluid">
    <a href="{{ route('roles.create') }}" class="btn btn-success btn-icon-split"> <span class="text">Crear nuevo rol</span> </a>
    <a href="{{ route('roles.asignar-rol') }}" class="btn btn-success btn-icon-split"><span class="text">Asignar rol a usaurio</span></a>    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de roles disponibles</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>Descripcion</th>
                        <th>Opciones</th>
                    </tr>
                    @foreach ($Roles as $rol)
                    <tr>
                        <td>{{$rol->id}}</td>
                        <td>{{$rol->name}}</td>
                        <td>
                            <form action="{{route('roles.destroy', ['rol'=> $rol]) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('roles.show', ['rol'=> $rol]) }}" class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                            <a href="{{ route('roles.edit', ['rol'=> $rol]) }}" class="btn btn-primary btn-sm fas fa-edit  cursor-pointer"></a>
                            <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                onclick="return confirm('¿ESTA SEGURO DE  BORRAR?')" value="Borrar">
                            </button>
                            </form>
                            
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>    
</div>
@endsection