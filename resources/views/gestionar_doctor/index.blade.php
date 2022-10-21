@extends('layouts.template')

@section('header')Medicos @endsection

@section('content')
    {{-- @foreach ($doctores as $doctor  ) --}}
    {{-- <p>nombre:{{$doctor->formacion}}</p> --}}
    {{-- @endforeach --}}
                   <!-- Begin Page Content -->
                   <div class="container-fluid">
                    <!-- Page Heading -->
                    
                    <p class="mb-4"></p>       
                    <a href="{{asset('/doctores.create')}}" class="btn btn-success btn-icon-split">
                        <span class="text">Registrar Medico</span>
                    </a>
                    <div class="my-2"></div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Medicos</h6>
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
                                            <th>especialidad</th>
                                            <th>Telefono</th>
                                            <th>Direccion</th>
                                            {{-- <th>Correo</th>
                                            <th>Usuario</th> --}}
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nrº</th>
                                            <th>CI</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Especialidad</th>
                                            <th>Telefono</th>
                                            <th>Direccion</th>
      
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($doctores as $doctor)
                                         
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <th>{{$doctor->persona->ci}}</th>
                                                <th>{{$doctor->persona->nombre}}</th>
                                                <th>{{$doctor->persona->apellido_paterno . " " . $doctor->persona->apellido_materno}}</th>
                                                <th>{{$doctor->especialidad->nombre}}</th>
                                                <th>{{$doctor->persona->telefono}}</th>
                                                <th>{{$doctor->persona->direccion}}</th>
                                                {{-- <th>{{$doctor->persona->user->email}}</th> --}}
                                                {{-- <th>{{$doctor->persona->user->name}}</th> --}}
                                                <td>
                                                    <form action="{{route('doctores.destroy', [$doctor->id])}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="#"
                                                            class="btn btn-primary btn-sm fas fa-edit  cursor-pointer"></a>
                                                        <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                                            onclick="return confirm('¿ESTA SEGURO DE  BORRAR?')" value="Borrar">
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
             

@endsection