@extends('layouts.template')

@section('header')Paciente:  <strong>{{$paciente->persona->nombre}}</strong>@endsection

@section('content')
@include('components.flash_alerts')
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- DataTales Example -->
  <div class="card shadow mb-4"  style="border-radius: 2rem">
    <div class="card-body">
      <h1 class="text-center">Historia clinica</h1>
      <form action="{{route('historialClinico.pdfGenerate',['paciente'=>$paciente])}}" method="POST">
        @method('post')
        @csrf
        <h3>Ficha de identificacion</h3>
        <div class="form-row">
          <div class="form-group col-4">
            <label for="nombre_completo">Nombre completo:</label>
            <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" value="{{old('nombre_completo',$paciente->persona->nombre." ".$paciente->persona->apellido_paterno." ".$paciente->persona->apellido_materno)}}">
          </div>
          <div class="form-group col-2">
            <label for="ci">Ci:</label>
            <input type="text" class="form-control" name="ci" id="ci" value="{{old('ci',$paciente->persona->ci)}}">
          </div>
          <div class="form-group col-3">
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{old('fecha_nacimiento', $paciente->persona->fecha_nacimiento)}}">
          </div>
          <div class="form-group col-3">
            <label for="telefono">Telefono:</label>
            <input type="text" class="form-control" name="telefono" id="telefono" value="{{old('telefono',$paciente->persona->telefono)}}">
          </div>

          <div class="form-group col-2">
            <label for="nombre">Edad:</label>
            <input type="text" class="form-control" name="edad" id="edad" value="{{old('edad',$paciente->persona->edad)}}">
          </div>
          <div class="form-group col-3">
            <label for="estado_civil">Estado civil:</label>
            <input type="text" class="form-control" name="estado_civil" id="estado_civil">
          </div>
          <div class="form-group col-3">
            <label for="ocupacion">Ocupacion:</label>
            <input type="text" class="form-control" name="ocupacion" id="ocupacion">
          </div>
          <div class="form-group col-4">
            <label for="religion">Religion:</label>
            <input type="text" class="form-control" name="religion" id="religion">
          </div>
          <div class="form-group col-4">
            <label for="lugar_origen">Lugar de origen:</label>
            <input type="text" class="form-control" name="lugar_origen" id="lugar_origen">
          </div>
          <div class="form-group col-4">
            <label for="lugar_residencia">Lugar de residencia:</label>
            <input type="text" class="form-control" name="lugar_residencia" id="lugar_residencia" value={{old('lugar_residencia',$paciente->persona->direccion)}}>
          </div>
          <div class="form-group col-4">
            <label for="sexo">Sexo:</label>
            <div>
              @if ($paciente->persona->sexo[0]=='M')
              <input type="radio" name="sexo" id="masculino" value="masculino" checked>
              <label for="masculino">Masculino</label>
              <input type="radio" name="sexo" id="femenino" value="femenino">
              <label for="femenino">Femenino</label>    
              @else
              <input type="radio" name="sexo" id="masculino" value="masculino">
              <label for="masculino">Masculino</label>
              <input type="radio" name="sexo" id="femenino" value="femenino" checked>
              <label for="femenino">Femenino</label>    
              @endif
            </div>
          </div>
          <div class="form-group col-12">
            <h6>Grupo etnico</h6>
            <div>
              @foreach ($GruposEtnicos as $grupoEtnico)
              <input type="radio" value="{{$grupoEtnico}}" name="grupo_etnico" id="{{$grupoEtnico}}">
              <label for="{{$grupoEtnico}}">{{$grupoEtnico}}</label>    
              @endforeach
              <input type="radio" value="ninguno" name="grupo_etnico" hidden checked>
            </div>
          </div>
          <div class="form-group col-2">
            <label for="estatura">Estatura:</label>
            <input type="text" class="form-control" name="estatura" id="estatura">
          </div>
          <div class="form-group col-2">
            <label for="peso">Peso:</label>
            <input type="text" class="form-control" name="peso" id="peso">
          </div>
          <div class="form-group col-2">
            <label for="tipo_sangre">Tipo de sangre:</label>
            <input type="text" class="form-control" name="tipo_sangre" id="tipo_sangre">
          </div>
        </div>


        <h3 class="my-3">Antecedentes Personales Patologicos</h3>
        <h5>Enfermedades que tiene o ha tenido en el pasado</h5>
        <div class="row px-3">
          @foreach ($AntecedentesPatologicos as $antecedente)
            <div class="d-flex col-4 justify-content-between">
              <div class="mx-2">
                <label>{{str_replace("_"," ",$antecedente)}}:</label>
              </div>
              <div class="d-flex">
                <div class="mx-2">
                  <input type="radio" value="si" name="{{$antecedente}}" id="{{$antecedente}}_si">
                  <label for="{{$antecedente}}_si">si</label>
                </div>
                <div class="mx-2">
                  <input type="radio" value="no" name="{{$antecedente}}" id="{{$antecedente}}_no" checked>
                  <label for="{{$antecedente}}_no">no</label>
                </div>
              </div>              
            </div>              
          @endforeach
        </div>
        <div class="form-row">
          <div class="form-group col-6">
            <label for="otra_enfermedad">Alguna otra enfermedad:</label>
            <input class="form-control" type="text" name="otra_enfermedad" id="otra_enfermedad">
          </div>
          <div class="form-group col-6">
            <label for="adiccion">Adiccion a:</label>
            <input class="form-control" type="text" name="adiccion" id="adiccion">
          </div>
        </div>
        <h5>Alergias</h5>
        <div class="row px-3">
          @foreach ($Alergias as $alergia)
            <div class="d-flex col-4 justify-content-between">
              <div class="mx-2">
                <label>{{str_replace("_", " ",$alergia)}}:</label>
              </div>
              <div class="d-flex">
                <div class="mx-2">
                  <input type="radio" value="si" name="{{$alergia}}" id="{{$alergia}}_si">
                  <label for="{{$alergia}}_si">si</label>
                </div>
                <div class="mx-2">
                  <input type="radio" value="no" name="{{$alergia}}" id="{{$alergia}}_no" checked>
                  <label for="{{$alergia}}_no">no</label>
                </div>
              </div>              
            </div>              
          @endforeach
        </div>
        <div class="form-row">
          <div class="form-group col">
            <label for="alergia_otros">Otras alergias:</label>
            <input type="text" class="form-control" name="alergia_otros" id="alergia_otros">
          </div>
        </div>
        <h3 class="my-3">Antecedentes Personales No Patologicos</h3>
        <h5>Habitos Toxicos:</h5>
        <div class="form-row">
          <div class="form-group col-6">
            <label for="alcohol">Alcohol: </label>
            <input type="text" class="form-control" name="alcohol" id="alcohol">
          </div>
          <div class="form-group col-6">
            <label for="tabaco">Tabaco: </label>
            <input type="text" class="form-control" name="tabaco" id="tabaco">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6">
            <label for="drogas">Drogas: </label>
            <input type="text" class="form-control" name="drogas" id="drogas">
          </div>
          <div class="form-group col-6">
            <label for="habito_toxico_otros">Otros: </label>
            <input type="text" class="form-control" name="habito_toxico_otros" id="habito_toxico_otros">
          </div>
        </div>
        <h5>Fisiologicos</h5>
        <div>
          <h6 class="my-3">Alimentacion</h6>
          <div class="form-row">
            <div class="form-gruop col-auto">
              <label for="nro_comidas">Numero de comidas al dia</label>
              <input type="text" class="form-control" name="nro_comidas" id="nro_comidas">
            </div>
            <div class="form-gruop col-auto">
              <label for="cant_comidas">Cantidad</label>
              <input type="text" class="form-control" name="cant_comidas" id="cant_comidas">
            </div>
            <div class="form-gruop col-auto">
              <label for="calidad_comidas">Calidad</label>
              <input type="text" class="form-control" name="calidad_comidas" id="calidad_comidas">
            </div>
            <div class="form-gruop col-auto">
              <label for="lts_agua">Litros de agua al dia</label>
              <input type="text" class="form-control" name="lts_agua" id="lts_agua">
            </div>
          </div>
        </div>
        <div>
          <h6 class="my-3">Habitacion</h6>
          <div class="form-row">
            <div class="form-gruop col-auto">
              <label for="habitacion_piso">Piso</label>
              <input type="text" class="form-control" name="habitacion_piso" id="habitacion_piso">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_ventilacion">Ventilacion</label>
              <input type="text" class="form-control" name="habitacion_ventilacion" id="habitacion_ventilacion">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_iluminacion">Iluminacion</label>
              <input type="text" class="form-control" name="habitacion_iluminacion" id="habitacion_iluminacion">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_agua">Agua potable</label>
              <input type="text" class="form-control" name="habitacion_agua" id="habitacion_agua">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_drenaje">Drenaje</label>
              <input type="text" class="form-control" name="habitacion_drenaje" id="habitacion_drenaje">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_gas">Gas</label>
              <input type="text" class="form-control" name="habitacion_gas" id="habitacion_gas">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_ambiente">Ambiente</label>
              <input type="text" class="form-control" name="habitacion_ambiente" id="habitacion_ambiente">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_cama">En que duerme</label>
              <input type="text" class="form-control" name="habitacion_cama" id="habitacion_cama">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_hacinamiento">Hacinamiento</label>
              <input type="text" class="form-control" name="habitacion_hacinamiento" id="habitacion_hacinamiento">
            </div>
            <div class="form-gruop col-auto">
              <label for="habitacion_fecalismo">Fecalismo</label>
              <input type="text" class="form-control" name="habitacion_fecalismo" id="habitacion_fecalismo">
            </div>
          </div>
        </div>
        <div>
          <h6 class="my-3">Inmunizacion</h6>
          <div class="form-row">
            <div class="form-gruop col-auto">
              <label for="inmunizacion_infancia">Infancia</label>
              <input type="text" class="form-control" name="inmunizacion_infancia" id="inmunizacion_infancia">
            </div>
            <div class="form-gruop col-auto">
              <label for="inmunizacion_reciente">Reciente</label>
              <input type="text" class="form-control" name="inmunizacion_reciente">
            </div>
          </div>
        </div>
        <h3 class="my-3">Antecedentes Familiares</h3>
          @foreach ($Heredofamiliares as $heredofamiliar)
          <div class="row px-3 my-2">
            <div class="d-flex col-5 justify-content-between">
              <div class="mx-2">
                <label for="">{{$heredofamiliar}}:</label>
              </div>
              <div class="d-flex">
                <div class="mx-2">
                  <input type="radio" value="si" name="{{$heredofamiliar}}" id="{{$heredofamiliar}}_si">
                  <label for="{{$heredofamiliar}}_si" >si</label>
                </div>
                <div class="mx-2">
                  <input type="radio" value="no" name="{{$heredofamiliar}}" id="{{$heredofamiliar}}_no" checked>
                  <label for="{{$heredofamiliar}}_no">no</label>
                </div>
              </div>              
            </div>    
            <div class="d-flex ">
              <label for="{{$heredofamiliar}}_parentesco">Parentesco: </label>
              <input class="form-control mx-2" type="text" name="{{$heredofamiliar}}_parentesco" id="{{$heredofamiliar}}_parentesco">
            </div>
            <div class="d-flex justify-content-between">
              <div class="mx-2">
                <label>vivo:</label>
              </div>
              <div class="d-flex">
                <div class="mx-2">
                  <input type="radio" value="si" name="{{$heredofamiliar}}_vivo" id="{{$heredofamiliar}}_vivo_si">
                  <label for="{{$heredofamiliar}}_vivo_si">si</label>
                </div>
                <div class="mx-2">
                  <input type="radio" value="no" name="{{$heredofamiliar}}_vivo" id="{{$heredofamiliar}}_vivo_no" >
                  <label for="{{$heredofamiliar}}_vivo_no">no</label>
                </div>
              </div>              
            </div>   
          </div>       
          @endforeach
        
        {{-- <div class="form-inline">
          <div class="d-flex">
            <div class="d-flex mx-3">
              <label for="">Otra enfermedad:</label>
              <input type="text" class="form-control mx-1" name="enfermedad_otros" id="enfermedad_otros">
            </div>
            <div class="d-flex mx-3">
              <label for="">Parentesco: </label>
              <input type="text" class="form-control mx-1" name="enfermedad_otros_parentesco" id="enfermedad_otros_parentesco">
            </div> 
            <div class="d-flex mx-3">
              <label for="">vivo:</label>
              <div class="d-flex mx-2">
                <input type="radio">
                <label for="">si</label>
              </div>
              <div class="d-flex mx-2">
                <input type="radio">
                <label for="">no</label>
              </div>
            </div>
          </div>
        </div> --}}
        <button type="submit" class="btn btn-primary my-5">Guardar</button>
        <button type="button" class="btn btn-danger my-5">Cancelar</button>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->    
@endsection