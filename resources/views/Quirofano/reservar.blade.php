@extends('layouts.template')

@section('header')Gestionar quirofano @endsection

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 3rem">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Reservar quirofano</h1>
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
                        <form class="user" action="{{ route('reservarQuirofano.store') }}"  method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="paciente">Seleccionar paciente:</label>
                                <select name="paciente" id="paciente" class="form-control" style="border-radius: 3rem">
                                    @foreach ($Pacientes as $paciente)
                                        <option value="{{$paciente->id}}" >
                                            {{$paciente->persona->ci}} - 
                                            {{$paciente->persona->nombre}}
                                            {{$paciente->persona->apellido_paterno}}
                                            {{$paciente->persona->apellido_materno}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="quirofano">Seleccionar sala de quirofano:</label>
                                <select name="quirofano" id="quirofano" class="form-control" style="border-radius: 3rem">
                                    @foreach ($Salas as $sala)
                                        <option value="{{$sala->id}}" >
                                            Nº sala: {{$sala->nro_sala}} - 
                                            {{$sala->sector->piso}} -
                                            {{$sala->sector->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                              <label for="fecha">Fecha:</label>
                              <input type="date" class="form-control form-control-user" id="fecha" name="fecha" value="{{ old('fecha') }}">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                              <label for="hora">Hora de inicio:</label>
                              <input type="time" class="form-control form-control-user" id="hora" name="hora" value="{{ old('hora') }}">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <label for="duracion">Duracion aproximada (Hrs):</label>
                              <input type="number" class="form-control form-control-user" id="duracion" name="duracion" value="{{ old('duracion') }}">
                            </div>
                        </div>
                          <h3>Equipo medico</h3>
                          <div class="form-row">
                            <div class="col-6">
                                <select name="doctor" id="doctor" class="form-control" style="border-radius: 3rem">
                                    @foreach ($Doctores as $doctor)
                                        <option value="{{$doctor->id}}" id="doctor_{{$doctor->id}}">
                                            {{$doctor->persona->nombre}}
                                            {{$doctor->persona->apellido_paterno}}
                                            {{$doctor->persona->apellido_materno}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                              <input type="text" name="funcion" id="funcion" class="form-control" style="border-radius: 3rem" placeholder="Funcion">
                            </div>
                            <div class="col">
                              <button type="button" id="btnAgregar" class="btn btn-primary  btn-block"  style="border-radius: 3rem">Agregar</button>
                            </div>
                          </div>                          
                          <h4>Medicos seleccionados</h4>
                          <table class="table table-sm">
                            <thead>
                              <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Funcion</th>
                              </tr>
                            </thead>
                            <tbody id="lista_doctores">
                              
                            </tbody>
                          </table>
                          <div id="form_hide">                            
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <input type="submit" class="btn btn-facebook btn-user btn-block" value="Aceptar">
                              </div>
                              <div class="col-sm-6 mb-3 mb-sm-0">
                                  <a href="{{ route('quirofano.index') }}"
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
  function agregarMedico(event){
    let Doctores = {{Js::from($Doctores)}};
    const doctor = document.querySelector('#doctor');
    let doctorSeleccionado = Doctores.find(doc => doc.id == doctor.value);
    let funcion = document.querySelector('#funcion');
    if(funcion.value == ""){
      alert("Error, no se ha especificado la funcion del doctor")
      return;
    }
    const tabla = document.querySelector('#lista_doctores');
    const filaTabla = document.createElement("tr");
    filaTabla.innerHTML = `
      <td>
        ${doctorSeleccionado.persona.nombre}
        ${doctorSeleccionado.persona.apellido_paterno}
        ${doctorSeleccionado.persona.apellido_materno}
      </td>
      <td>${doctorSeleccionado.especialidad}</td>
      <td>${funcion.value}</td>
    `;
    tabla.appendChild(filaTabla);    
    let opcionDoctor = document.querySelector(`#doctor_${doctorSeleccionado.id}`)
    doctor.removeChild(opcionDoctor);
    const formHide = document.querySelector('#form_hide');
    let inputHideDoctor = document.createElement('input');
    inputHideDoctor.name = 'doctores[]';
    inputHideDoctor.value = `${doctorSeleccionado.id}_${funcion.value}`;
    inputHideDoctor.type = 'hidden';
    formHide.appendChild(inputHideDoctor);
  }
  function eliminarMedico(event){
    console.log(event);
  }
  const btnAgregar = document.querySelector('#btnAgregar');
  btnAgregar.addEventListener('click', agregarMedico);
</script>
@endsection

