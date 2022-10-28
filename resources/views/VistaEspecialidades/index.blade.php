@extends('layouts.template')

@section('header')Turnos de trabajo @endsection

@section('content')
<div class="container-fluid">
    <a href="{{route('especialidad.create')}}" class="btn btn-success btn-icon-split"> <span class="text">Crear nuevo turno</span> </a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de especialidades disponibles</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                         
                    </tr>
                    @foreach ($especialidades as $especialidad)
                    <tr>
                        <td>{{$especialidad->id}}</td>
                        <td>{{$especialidad->descripcion}}</td>
                        <td>{{$especialidad->hora_inicio}}</td>
                        <td>{{$especialidad->hora_fin}}</td>
                        <td>
                            <form action="{{route('especialidad.destroy',['especialidad'=>$especialidad])}}" method="post">
                            @csrf
                            @method('delete')
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

<div class="container-fluid">
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Horarios de trabajo de los doctores</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID Doctor</th>
                        <th>Nombre</th>
                        <th>Turnos</th>
                        <th>Opciones</th>    
                    </tr>
                    @foreach ($Doctores as $doctor)
                    <tr>
                        <td>{{$doctor->id}}</td>
                        <td>{{$doctor->persona->nombre}}</td>
                        @if ($doctor->turnoDoctor->isNotEmpty())
                            <td>asignado</td>
                            <td>
                                <a href="{{route('turno-doctor.show',['doctor'=>$doctor])}}" class="btn btn-primary fas fa-edit cursor-pointer"></a> 
                            </td>
                        @else
                            <td>sin asignar</td>
                            <td>
                                <a href="{{route('turno-doctor.asignar',['doctor'=>$doctor])}}" class="btn btn-info btn-sm cursor-pointer">asignar</a> 
                            </td>
                        @endif  
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>    
</div>
@endsection