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
                            <form id="HojaConsulta" class="user" action="{{ route('hojaconsulta.store') }}"  method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <h4 class="col-auto">Medico: <strong>{{Auth::user()->persona->nombre}}
                                            {{Auth::user()->persona->apellido_paterno}}
                                            {{Auth::user()->persona->apellido_materno}} -
                                            {{Auth::user()->name}}</strong></h4>

                                        <input name="doctor_id" type="hidden" id="doctor_id" value={{$hojaconsulta->consulta->doctor->id}}>
                                    </div>

                                    <div class="col-sm-6">
                                        <h4 class="col-auto">Numero de cita: <strong>{{$hojaconsulta->consulta->cita->id}}</strong></h4>
                                    </div>  
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <h4 class="col-auto">Paciente: <strong>{{$hojaconsulta->consulta->cita->paciente->persona->nombre}}</strong></h4>
                                        <input name="cita_id" type="hidden" id="cita_id" value={{$hojaconsulta->consulta->cita->id}}>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="fecha_agendar">Motivo de consulta:</label>
                                        <textarea class="form-control"  type="text" name="motivo" id="motivo" disabled>{{$hojaconsulta->consulta->cita->motivo}}</textarea>   
                                        <input name="consulta_id" type="hidden" id="consultaid"  value={{($hojaconsulta->consulta_id)}}>
                                <input name="expediente_id" type="hidden" id="expedienteid" value={{$hojaconsulta->expediente_id}}>
                                
                                    </div>  
                                </div>

                                
                                <div class="form-group">
                                    <label for="fecha_agendar">Sintomas:</label>
                                    <textarea class="form-control"  type="text" name="sintomas" id="motivo" disabled value="">{{$hojaconsulta->sintomas}}</textarea>                                     
                                </div>
                                <div class="form-group ">
                                    <label for="fecha_agendar">Impresion diagnostica:</label>
                                     <textarea class="form-control"  type="text" name="impresion_diagnostica" id="motivo" disabled>{{$hojaconsulta->impresion_diagnostica}}</textarea>
                                </div> 
                               <div class="form-group ">
                                    <label for="fecha_agendar">Indicaciones medicas:</label>
                                    <textarea class="form-control"  type="text" name="indicaciones_medica" id="indicaciones_medica" disabled value="">{{$hojaconsulta->indicaciones_medica}}</textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="fecha_agendar">Proxima consulta:</label>
                                        <input type="date" class="form-control form-control-user" id="exampleInputEmail"
                                        name="proxima_consulta"  value="{{ $hojaconsulta->proxima_consulta }}" disabled>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="submit" form="HojaConsulta" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <a href="{{route('consulta.index')}}"
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