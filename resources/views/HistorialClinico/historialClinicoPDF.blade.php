<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    header{
      width: 100%;
      margin: 1rem auto;
    }
    .titulo{
      padding: 0;
      margin: 0;
    }
    .logo{
      display: inline-block;
    }
    .titulos-encabezado{
      max-width: max-content;
      display: inline-block;
    }
    .titulo-seccion{
      background: rgb(158, 155, 155);
      font-size: 14px;
      font-weight: 700;
      padding: 0.2rem;
      margin: 0.5rem 0;
    }
    .informacion{
      margin: 0.2rem;      
      font-size: 12px;
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    .campo{
      font-weight: bold;
    }
    .dato{
      border-bottom: 1px solid black;
    }
    .datos{
      margin: 0.3rem;
      
      display: inline-block;
    }
    .block{
      display: block;
    }
    .datos-container{
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    .subtitulo{
      font-size: 12px;
      font-weight: bold;
      color: rgb(117, 117, 117);
    }
  </style>
  <title>Document</title>
</head>
<body>
  <header>
    @if ($clinica != null)
    <img class="logo" src="{{public_path(Storage::url($clinica->logo_url))}}" width="100">
    <div class="titulos-encabezado">
      <h1 class="titulo">{{$clinica->nombre}}</h1>
      <h2 class="titulo">Historia Clinica</h2>
    </div>    
    @else
    <div class="titulos-encabezado">
      <h2 class="titulo">Historia Clinica</h2>
    </div>
    @endif
    
  </header>
  <main>
    <div class="informacion">
      <div class="datos">
        <span class="campo">Nº Historia Clinica: </span>
        <span class="dato">{{$HC_codigo}}</span>
      </div>
      <div class="datos">
        <span class="campo">Fecha y hora de elaboracion: </span>
        <span class="dato">{{$fecha_hora->toDateTimeString()}}</span>
      </div>
      <div class="datos">
        <span class="campo">Nombre del medico: </span>
        <span class="dato">{{$doctor->nombre." ".$doctor->apellido_paterno." ".$doctor->apellido_materno}}</span>
      </div>
    </div>
    <div class="datos-container">
      <div class="titulo-seccion">
        <span>Ficha de identificacion del paciente:</span>
      </div>
      <div class="informacion">
        <div class="datos">
          <span class="campo">Nombre completo: </span>
          <span class="dato">{{$formulario->nombre_completo}} </span>
        </div>
        <div class="datos">
          <span class="campo">CI: </span>
          <span class="dato">{{$formulario->ci}} </span>
        </div>
        <div class="datos">
          <span class="campo">Fecha nacimiento: </span>
          <span class="dato">{{$formulario->fecha_nacimiento}} </span>
        </div>
        <div class="datos">
          <span class="campo">Telefono: </span>
          <span class="dato">{{$formulario->telefono}} </span>
        </div>
        <div class="datos">
          <span class="campo">edad: </span>
          <span class="dato">{{$formulario->edad}} </span>
        </div>
        <div class="datos">
          <span class="campo">Estado civil: </span>
          <span class="dato">{{$formulario->estado_civil}} </span>
        </div>
        <div class="datos">
          <span class="campo">Ocupacion: </span>
          <span class="dato">{{$formulario->ocupacion}} </span>
        </div>
        <div class="datos">
          <span class="campo">Religion: </span>
          <span class="dato">{{$formulario->religion}} </span>
        </div>
        <div class="datos">
          <span class="campo">Lugar de origen: </span>
          <span class="dato">{{$formulario->lugar_origen}} </span>
        </div>
        <div class="datos">
          <span class="campo">Lugar de residencia: </span>
          <span class="dato">{{$formulario->lugar_residencia}} </span>
        </div>
        <div class="datos">
          <span class="campo">Sexo: </span>
          <span class="dato">{{$formulario->sexo}} </span>
        </div>
        <div class="datos">
          <span class="campo">Grupo etnico: </span>
          <span class="dato">{{$formulario->grupo_etnico}} </span>
        </div>
        <div class="datos">
          <span class="campo">Estatura: </span>
          <span class="dato">{{$formulario->estatura}} </span>
        </div>
        <div class="datos">
          <span class="campo">Peso: </span>
          <span class="dato">{{$formulario->peso}} </span>
        </div>
        <div class="datos">
          <span class="campo">Tipo de sangre: </span>
          <span class="dato">{{$formulario->tipo_sangre}} </span>
        </div>
      </div>  
    </div>
    <div class="datos-container">
      <div class="titulo-seccion">
        <span>Antecedentes Personales Patologicos:</span>
      </div>
      <div class="subtitulo">
        <span >Enfermedades que tiene o ha tenido en el pasado:</span>
      </div>
      <div class="informacion">
        @foreach ($AntecedentesPatologicos as $enfermedad)
        <div class="datos">
          <span class="campo">{{str_replace("_"," ",$enfermedad)}}: </span>
          <span class="dato">{{$formulario->get($enfermedad)}}</span>
        </div>    
        @endforeach
        @if ($formulario->otra_enfermedad != null)
        <div class="datos">
          <span class="campo">Otras enfermedades: </span>
          <span class="dato">{{$formulario->otra_enfermedad}}</span>
        </div>    
        @else
        <div class="datos">
          <span class="campo">Otras enfermedades: </span>
          <span class="dato">no</span>
        </div>    
        @endif
        @if ($formulario->adiccion != null)
        <div class="datos">
          <span class="campo">Adicciones: </span>
          <span class="dato">{{$formulario->adiccion}}</span>
        </div>    
        @else
        <div class="datos">
          <span class="campo">Adicciones: </span>
          <span class="dato">no</span>
        </div>    
        @endif
      </div>  
      <div class="subtitulo">
        <span >Alergias:</span>
      </div>
      <div class="informacion">
        @foreach ($Alergias as $alergia)
        <div class="datos">
          <span class="campo">{{str_replace("_"," ",$alergia)}}: </span>
          <span class="dato">{{$formulario->get($alergia)}}</span>
        </div>    
        @endforeach
        @if ($formulario->alergia_otros != null)
        <div class="datos">
          <span class="campo">Otras alergias: </span>
          <span class="dato">{{$formulario->alergia_otros}}</span>
        </div>    
        @else
        <div class="datos">
          <span class="campo">Otras alergias: </span>
          <span class="dato">no</span>
        </div>    
        @endif
      </div>  
    </div>
    <div class="datos-container">
      <div class="titulo-seccion">
        <span>Antecedentes Personales No Patologicos:</span>
      </div>
      <div class="subtitulo">
        <span >Habitos toxicos:</span>
      </div>
      <div class="informacion">
        <div class="datos">
          <span class="campo">Alcohol: </span>
          <span class="dato">{{$formulario->alcohol}}</span>
        </div>
        <div class="datos">
          <span class="campo">Tabaco: </span>
          <span class="dato">{{$formulario->tabaco}}</span>
        </div>
        <div class="datos">
          <span class="campo">Drogas: </span>
          <span class="dato">{{$formulario->drogas}}</span>
        </div>
        @if ($formulario->habito_toxico_otros == null)
        <div class="datos">
          <span class="campo">Otros: </span>
          <span class="dato">no</span>
        </div>    
        @else    
        <div class="datos">
          <span class="campo">Otros: </span>
          <span class="dato">{{$formulario->habito_toxico_otros}}</span>
        </div>    
        @endif
      </div>  
      <div class="subtitulo">
        <span>Alimentacion:</span>
      </div>
      <div class="informacion">
        <div class="datos">
          <span class="campo">Numero de comidas al dia: </span>
          <span class="dato">{{$formulario->nro_comidas}}</span>
        </div>
        <div class="datos">
          <span class="campo">Cantidad: </span>
          <span class="dato">{{$formulario->cant_comidas}}</span>
        </div>
        <div class="datos">
          <span class="campo">Calidad: </span>
          <span class="dato">{{$formulario->calidad_comidas}}</span>
        </div>
        <div class="datos">
          <span class="campo">Litros de agua al dia: </span>
          <span class="dato">{{$formulario->lts_agua}}</span>
        </div>
      </div>  
      <div class="subtitulo">
        <span>Habitacion:</span>
      </div>
      <div class="informacion">
        <div class="datos">
          <span class="campo">Piso: </span>
          <span class="dato">{{$formulario->habitacion_piso}}</span>
        </div>
        <div class="datos">
          <span class="campo">Ventilacion: </span>
          <span class="dato">{{$formulario->habitacion_ventilacion}}</span>
        </div>
        <div class="datos">
          <span class="campo">Iluminacion: </span>
          <span class="dato">{{$formulario->habitacion_iluminacion}}</span>
        </div>
        <div class="datos">
          <span class="campo">Agua: </span>
          <span class="dato">{{$formulario->habitacion_agua}}</span>
        </div>
        <div class="datos">
          <span class="campo">Drenaje: </span>
          <span class="dato">{{$formulario->habitacion_drenaje}}</span>
        </div>
        <div class="datos">
          <span class="campo">Gas: </span>
          <span class="dato">{{$formulario->habitacion_gas}}</span>
        </div>
        <div class="datos">
          <span class="campo">Ambiente: </span>
          <span class="dato">{{$formulario->habitacion_ambiente}}</span>
        </div>
        <div class="datos">
          <span class="campo">En que duerme: </span>
          <span class="dato">{{$formulario->habitacion_cama}}</span>
        </div>
        <div class="datos">
          <span class="campo">Fecalismo: </span>
          <span class="dato">{{$formulario->habitacion_fecalismo}}</span>
        </div>
      </div>  
      <div class="subtitulo">
        <span>Inmunizacion:</span>
      </div>
      <div class="informacion">
        <div class="datos">
          <span class="campo">Infancia: </span>
          <span class="dato">{{$formulario->inmunizacion_infancia}}</span>
        </div>
        <div class="datos">
          <span class="campo">Reciente: </span>
          <span class="dato">{{$formulario->inmunizacion_reciente}}</span>
        </div>
      </div>
    </div>
    <div class="datos-container">
      <div class="titulo-seccion">
        <span>Antecedentes heredo familiares:</span>
      </div>
      <div class="informacion">
        @foreach ($Heredofamiliares as $enfermedad)
        <div class="datos block">
          <span class="campo">{{$enfermedad}}: </span>
          <span class="dato">{{$formulario->get($enfermedad)}} </span>
          @if ($formulario->get($enfermedad) == "si")
          <span class="campo">Parentesco: </span>
          <span class="dato">{{$formulario->get($enfermedad."_"."parentesco")}} </span>
          <span class="campo">Vivo: </span>
          <span class="dato">{{$formulario->get($enfermedad."_"."vivo")}} </span>    
          @endif
        </div>
        @endforeach
      </div>  
    </div>
  </main>
  <footer>

  </footer>
</body>
</html>