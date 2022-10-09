@extends('layouts.template')

@section('header')Administrativo @endsection

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    
                    <p class="mb-4"></p>       
                    <a href="{{asset('/administrativo.create')}}" class="btn btn-success btn-icon-split">
                        <span class="text">Registrar Administrativo</span>
                    </a>
                    <div class="my-2"></div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de administrativo</h6>
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
                                            <th>Cargo</th>
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
                                            <th>Cargo</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp

                                        @foreach ($administrativos as $administrativo)
                                         
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <th>{{$administrativo->persona->ci}}</th>
                                                <th>{{$administrativo->persona->nombre}}</th>
                                                <th>{{$administrativo->persona->apellido_paterno . " " . $administrativo->persona->apellido_materno}}</th>
                                                <th>{{$administrativo->cargo}}</th>
                                                <th>{{$administrativo->persona->user->name}}</th>
                                                <td>
                                                    <form action="{{route('administrativo.destroy',$administrativo->persona_id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="{{route('administrativo.show',$administrativo->persona_id)}}" class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                                                        <a href="{{route('administrativo.edit',$administrativo->persona_id)}}"
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