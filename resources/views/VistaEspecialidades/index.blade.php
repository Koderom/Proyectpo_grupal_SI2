@extends('layouts.template')

@section('header')Especialidades @endsection

@section('content')
<div class="container-fluid">
    <a href="{{route('especialidad.create')}}" class="btn btn-success btn-icon-split"> <span class="text">Crear nueva especialidad</span> </a>
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de especialidades disponibles</h6>
        </div> --}}

        {{-- <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                         
                    </tr> --}}
                    {{-- @foreach ($especialidad)
                    <tr>
                        <td>{{$especialidad->id}}</td>
                        <td>{{$especialidad->nombre}}</td>
                        <td> --}}
                            {{-- <form action="{{route('especialidad.destroy',['especialidad'=>$especialidad])}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                onclick="return confirm('¿ESTA SEGURO DE  BORRAR?')" value="Borrar">
                            </button>
                            </form> --}}
                            
                        {{-- </td>
                    </tr> --}}
                    {{-- @endforeach --}}
                </table>
            </div>
        </div>
    </div>    
</div>

<div class="container-fluid">
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Especialidades Disponibles</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Especialidad</th>
                            <th>Nombre</th>   
                            <th>Accion</th>     
                        </tr> 
                    </thead>
                    <tbody>
                        @forelse ($especialidades as $e)
                        <tr>
                            <td>{{$e->id}}</td>
                            <td>{{$e->nombre}}</td>
                            <td>
                                <form action="{{route('especialidad.destroy',$e->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('especialidad.edit',$e->id)}}" tipe="button" class="btn btn-primary btn-sm fas fa-edit"></a>
                                    <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                        onclick="return confirm('¿ESTA SEGURO DE  BORRAR?')" value="Borrar">
                                    </button>
                                </form> 
                            </td>
                            
                        </tr>
                        @empty
                        <p>
                            no hay datos
                        </p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>
@endsection