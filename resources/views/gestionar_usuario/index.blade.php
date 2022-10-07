@extends('layouts.template')

@section('header')Usuario @endsection

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    
                    <p class="mb-4"></p>       

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
                                            <th>Nombre</th>
                                            <th>Usuario</th><!--unique-->
                                            <th>Acciones</th><!--unique-->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nrº</th>
                                            <th>Nombre</th>
                                            <th>Usuario</th><!--unique-->
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
                                                <th>{{$usuario->name}}</th>
                                                <th>{{$usuario->email}}</th><!--nullable-->
                                                <td>
                                                    <form action="{{ route('administrativo.destroy', [$usuario->id]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="{{ route('administrativo.edit', [$usuario->id]) }}"
                                                            class="btn btn-primary btn-sm fas fa-edit  cursor-pointer"></a>
                                                        <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                                            onclick="return confirm('¿ESTA SEGURO DE  BORRAR?')" value="Borrar"> </button>
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