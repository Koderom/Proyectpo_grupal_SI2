@extends('layouts.template')

@section('header')Usuario @endsection

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    
                    <div class="my-2"></div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nrº</th>
                                            <th>CI</th>
                                            <th>Nombre</th>
                                            <th>Usuario</th>
                                            <th>Tipo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nrº</th>
                                            {{-- <th>CI</th> --}}
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Tipo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $i = 1;
         
                                        @endphp

                                        @foreach ($usuarios as $usuario)
                                         
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                {{-- <th>{{$usuario->persona->ci}}</th> --}}
                                                <th>{{$usuario->persona->nombre." ".$usuario->persona->apellido_paterno . " " . $usuario->persona->apellido_materno }}</th>
                                                <th>{{$usuario->email}}</th>
                                                <th>{{$usuario->persona->tipo}}</th>
                                                <td>
                                                    <form action="{{route('usuario.destroy',$usuario->persona_id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @if($usuario->persona->tipo[0]=='A')
                                                        <a href="{{route('administrativo.show',$usuario->persona_id)}}" class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                                                        @endif
                                                        @if($usuario->persona->tipo[0]=='P')
                                                        <a href="{{route('paciente.show',$usuario->persona_id)}}" class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                                                        @endif
                                                        @if($usuario->persona->tipo[0]=='D')
                                                        <a href="#" class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                                                        @endif
                                                        
                                                        <a href="{{route('usuario.edit',$usuario->persona_id)}}"
                                                            class="btn btn-primary btn-sm fas fa-edit  cursor-pointer"></a>
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
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->    
@endsection