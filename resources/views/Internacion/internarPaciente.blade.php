@extends('layouts.template')

@section('header')Gestionar internación @endsection

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 3rem">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrar Sala</h1>
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
                        <form class="user" action="{{ route('internacion.internarPaciente.store') }}"  method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label for="sector">Seleccionar sector:</label>
                              <select name="sector" id="sector" class="form-control" style="border-radius: 3rem">
                                @foreach ($Sectores as $sector)
                                  <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="sala">Seleccionar sala de Internacion:</label>
                                <select name="sala" id="sala" class="form-control" style="border-radius: 3rem">
                                  @foreach ($Sectores[0]->sala as $sala)
                                  @if($sala->tipo_sala[0] == 'I')
                                    <option value="{{$sala->id}}">Sala nº:{{$sala->nro_sala}}-{{$sala->internacion->tipoInternacion->descripcion}}</option>    
                                  @endif
                                  
                                  @endforeach
                                </select>                            
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                              <label for="paciente">Seleccionar paciente:</label>
                              <select name="paciente" id="paciente" class="form-control" style="border-radius: 3rem">
                                @foreach ($Pacientes as $paciente)
                                  <option value="{{$paciente->id}}">
                                    {{$paciente->persona->ci}} -
                                    {{$paciente->persona->nombre}}
                                    {{$paciente->persona->apellido_paterno}}
                                    {{$paciente->persona->apellido_materno}}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <a href="{{ route('internacion.index') }}"
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
<script>
    function cargarSalas(event){
        let Salas = {{Js::from($Salas)}};
        let idSector = event.target.value;
        const salaOpciones = document.querySelector('#sala');
        salaOpciones.innerHTML = "";
        let salasSector = "";
        Salas.forEach(sala => {
            if(sala.sector_id == idSector){
                salasSector = salasSector + `
                    <option value="${sala.id}">Sala nº:${sala.nro_sala}-${sala.internacion.tipo_internacion.descripcion}</option>
                `;
            }
        });
        console.log(Salas);
        salaOpciones.innerHTML = salasSector;
    }
    const selectSector = document.querySelector('#sector');
    selectSector.addEventListener('change',cargarSalas);
    selectSector.addEventListener('click',cargarSalas);
</script>
@endsection

