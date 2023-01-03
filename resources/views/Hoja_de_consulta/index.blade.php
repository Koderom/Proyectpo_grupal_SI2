@extends('layouts.template')

@section('header')
    Hoja de Consulta
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <p class="mb-4"></p>
        <div class="my-2"></div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Hoja de consultas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nrº</th>
                                <th>ID</th>
                                <th>Diagnostico</th>
                                <th>Paciente</th>
                                <th>Cita</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nrº</th>
                                <th>ID</th>
                                <th>Diagnostico</th>
                                <th>Paciente</th>
                                <th>Cita</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($hojaconsultas as $hojaconsulta)
                                @if ($hojaconsulta->consulta->doctor->id==$doctor->id)                                
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <th>{{ $hojaconsulta->id }}</th>
                                    <th>{{ $hojaconsulta->impresion_diagnostica}}</th>
                                    <th>{{ $hojaconsulta->expediente->paciente->persona->nombre}}</th>
                                    <th>{{ $hojaconsulta->consulta->cita->id }}</th>
                                    <th>
                                        <form action="{{route('receta.store',['hojaconsultaid'=>$hojaconsulta->id,'expedienteid'=>$hojaconsulta->expediente->id])}}"
                                            method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-light float-right" data-toggle="modal"
                                            style="background-color:#71a1d3d9;   border-radius: 12px;" id="consultabutton{{$i}}">
                                            <span>
                                                <i class="fa fa-plus " style="color: #f8f8f8"></i>
                                            </span>Agregar receta
                                            </button>
                                        </form>
                                        @foreach ($recetas as $receta)
                                            @if ($receta->hoja_consulta_id==$hojaconsulta->id)
                                                <a href="{{ route('receta.medicamento.show',['hojaconsulta_id'=>$hojaconsulta->id]) }}" id="{{$i}}" class="dropdown-item btn btn-info btn-sm cursor-pointer"><i class="fas fa-eye "></i> Ver receta</a>         
                                                    <script>
                                                        verConsulta=!!document.getElementById({{$i}});
                                                        if (verConsulta==true) {
                                                        button = document.getElementById('consultabutton'+{{$i}});
                                                        button.style.display='none';
                                                        }
                                                    </script>
                                            @endif
                                        @endforeach
                                    </th>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection