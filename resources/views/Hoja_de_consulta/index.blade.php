@extends('layouts.template')

@section('header')Consulta @endsection

@section('content')

    <div class="container">
        <div class="card border-0 shadow-lg my-0"><!--o-hidden-->
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col-lg-7">
                        <div class="p-mgps" style="padding: 3rem; background-color: #c9d5d7;">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><strong>HOJA DE CONSULTA</strong></h1>
                            </div>
                            {{ csrf_field() }}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- personas.create=stores-->
                            <form class="user" action="{{ route('hojaconsulta.store') }}"  method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <h4 class="col-auto">Medico: <strong>{{$doctor->persona->nombre}}</strong></h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="col-auto">Numero de cita: <strong>{{$citaactual->id}}</strong></h4>
                                    </div>  
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <h4 class="col-auto">Paciente: <strong>{{$datosPaciente[0]->nombre}}</strong></h4>
                                           
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="fecha_agendar">Motivo de consulta:</label>
                                        <textarea class="form-control"  type="text" name="motivo" id="motivo" disabled>{{$citaactual->motivo}}</textarea>   
                                   
                                    </div>  
                                 </div>
                                <div class="form-group">
                                    <label for="fecha_agendar">Sintomas:</label>
                                    <textarea class="form-control"  type="text" name="sintomas" id="motivo" value="{{old('sintomas')}}"></textarea>                                     
                                </div>
                                <div class="form-group ">
                                    <label for="fecha_agendar">Impresion diagnostica:</label>
                                     <textarea class="form-control"  type="text" name="impresion_diagnostica" id="motivo" value="{{old('impresion_diagnostica')}}"></textarea>
                                </div> 
                               <div class="form-group ">
                                    <label for="fecha_agendar">Indicaciones medicas:</label>
                                    <textarea class="form-control"  type="text" name="indicaciones_medica" id="motivo" value="{{old('indicaciones_medica')}}"></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="fecha_agendar">Proxima consulta:</label>
                                        <input type="date" class="form-control form-control-user" id="exampleInputEmail"
                                        name="proxima_consulta"  value="{{ old('proxima_consulta') }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-sm btn-light float-right" data-toggle="modal" data-target="#exampleModalCenterTitle"
                                        style="background-color:#1cc88a; margin: 15px 10px; padding: 10px 40px; border-radius: 12px; font-size: large;">
                                        <span>
                                            <i class="fa fa-plus " style="color: #f8f8f8"></i>
                                        </span>
                                              Recetar
                                        </button>

                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a href="#"
                                            class="btn btn-primary btn-user btn-block">
                                            Cancelar
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<div class="modal fade" id="exampleModalCenterTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #36b9cc; color: white">
                <h5 class="modal-title" id="exampleModalLongTitle">Registrar Receta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="col-xs-6 col-sm-6 col-md-12 mt-3">
                        <label style="color: #0b1949" for="ci" class="form-label la">Hoja de consulta:</label>
                        <!--select name="lista_material" id="lista_material" class="form-control shadow-sm" value="1" required>

                        </select-->
                        <input name="fecha_c" type="text" class="form-control shadow-sm" id="fecha_c" for="fecha_c"
                            value="1" />
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                        <label style="color: #061030" for="cantidad" class="form-label la">Expediente</label>
                        <input name="cantidad" type="text" class="form-control
                        shadow-sm"
                            id="cantidad" for="cantidad" value='1-Brant Schamberger'>
                        @error('cantidad')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 mt-3">
                        <label style="color: #fbaf32" for="fecha_c" class="form-label la">Fecha de Compra:</label>
                        <input name="fecha_c" type="date" class="form-control shadow-sm" id="fecha_c" for="fecha_c"
                            value="{{ old('fecha_c') }}" />
                        @error('fecha_c')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background: #1cc88a; border-color: #fbaf32;">
                        Recetar</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection