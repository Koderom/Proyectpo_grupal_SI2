@extends('layouts.template')

@section('header')Consulta @endsection

@section('content')


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row  p-2">
                <h3 class="col-auto col-md-7">Medico: <strong>{{$doctor->persona->nombre}}</strong></h3>
                <h4 class="col-auto">Fecha: <strong>{{$fechaActual}}</strong></h4>
            </div>
            <!--form action="#" method="GET" class="form-inline">
                @csrf
                    <div class="form-group">
                        <label for="fecha">Seleccione una fecha</label>
                        <select class="form-control" name="fecha" id="fecha">
                            @foreach ($doctor->agenda as $agenda)
                                <option value="{{$agenda->fecha}}"> {{$agenda->fecha}}</option>
                            @endforeach
                        </select>
                    </div>                    
                    <input class="btn btn-primary col-2" type="submit" value="Buscar">
            </form-->
        </div>
        <div class="card-body">
            <div class="row p-3">
                @php
                 $i = 1;
                 $NombreDoctor= $doctor->persona->nombre .' '. $doctor->persona->apellido_paterno .' '. $doctor->persona->apellido_materno;
                @endphp
                @foreach ($Citas as $cita)                        
                        <div class="col-xl-3 col-lg-4 col-sm-6 ">
                            <div class="card bg-light mb-3" style="max-width: 18rem;">
                               
                    @switch($cita->confirmado)
                        @case('0')
                                    <div class="card-header">
                                        <span class="row">Cita Nª:<strong>{{$i++}}</strong> </span> 
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><span class="">Hora de cita: {{ Str::substr($cita->hora_cita,0,5) }}</span> </h5>
                                        <p class="card-text"> <strong>Paciente:</strong> 
                                            {{$cita->paciente->persona->nombre}}
                                            {{$cita->paciente->persona->apellido_paterno}}
                                            {{$cita->paciente->persona->apellido_materno}}
                                        </p>
                                        <p class="card-text"> <strong>Motivo:</strong> 
                                            {{$cita->motivo}}
                                        </p>
                                        <div>
                                            <span class="text-warning">Reservado</span>
                                            {{-- <a href="{{route('cita.confirmar',['cupo'=>$cupo])}}" class="col">Confirmar</a>     --}}
                                        </div>
                                    </div>
                                </div>
                            
                            @break
                        @case('1')
                                <div class="card-header">
                                    <span class="row">Cita N.º: <strong>{{$i++}}</strong> </span> 
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><span class="">Hora: {{ Str::substr($cita->hora_cita,0,5) }}</span> </h5>
                                    <p class="card-text"> <strong>Paciente:</strong> 
                                        {{$cita->paciente->persona->nombre}}
                                        {{$cita->paciente->persona->apellido_paterno}}
                                        {{$cita->paciente->persona->apellido_materno}}
                                    </p>
                                    <p class="card-text"> <strong>Motivo:</strong> 
                                        {{$cita->motivo}}
                                    </p>
                                    @php
                                    $citaid=$cita->id;
                                    $pacienteSeleccionado=$cita->paciente->persona->nombre.' '.
                                    $cita->paciente->persona->apellido_paterno.' '.
                                    $cita->paciente->persona->apellido_materno;
                                    @endphp
                                    <div>
                                        <span class="text-success">Confirmado</span>
                                        <!--a href="#" class="col">Ver</a-->
                                        <form action="{{ route('consulta.store',['doctorid'=>$doctor->id,'citaid'=>$citaid]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light float-right" data-toggle="modal"
                                            style="background-color:#71a1d3d9;   border-radius: 12px;" id="">
                                            <span>
                                                <i class="fa fa-plus " style="color: #f8f8f8"></i>
                                            </span>
                                                Consulta
                                            </button>    
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @break
                        @default

                        </div>
                    @endswitch
                </div>    
                <script>
                    function editar(id, citaid) {
                        console.log(citaid);
                      var ModalEdit = new bootstrap.Modal(EditModal, {}).show();
                      document.getElementById('namepaciente').value = citaid+"-"+id;
                      document.getElementById('idcita').value = citaid;
                    }
                  </script> 
                
                @endforeach
<!--modal-->
        {{-- <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #1e5b5e; color: white">
                        <h5 class="modal-title" id="exampleModalLongTitle"> Consulta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <br>
                    </div>
                    <form action="{{ route('consulta.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            
                            <div class="col-xs-6 col-sm-6 col-md-12 mt-3">
                                <label style="color: #0b1949" for="descripcion" class="form-label la">Doctor:</label>
                                <input type="text" class="form-control shadow-sm"
                                        id="descripcion"  value="{{$NombreDoctor}}" style="width: 80%" required readonly>
                                <input name="doctor_id" type="hidden" id="doctor" value={{$doctor->id}} >
                            </div>
                            <!--div class="form-group row"-->
                            <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                                <label style="color: #061030" for="cantidad_por_unidad" class="form-label la">N.º Cita-Paciente:</label>
                                <input type="text" class="form-control
                                    shadow-sm" id="namepaciente" style="width: 160%" required readonly>
                                <input name="cita_id" type="hidden" id="idcita">
                                    @error('cita_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <!--/div-->
                            <br>
                        </div>
                        <div class="modal-footer">
                            <br>
                            <button type="submit" class="btn btn-primary" style="background: #1cc88a; border-color: #fbaf32;">
                                Hoja de consulta
                            </button>
                        </div>
                        <br>
                    </form>

                </div>
            </div>
        </div> --}}
<!--  --->


            </div>
        </div>
    </div>    
</div>

@endsection