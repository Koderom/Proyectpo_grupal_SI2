<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    *{
      font-size: 10px;
      border: 0;
      margin: 0;
      box-sizing: content-box;
    }
    body{
      margin: 3rem;
      overflow: hidden;
    }
    header{
      width: 100%;
      margin: 1rem auto;
      background-color:#056676;
      padding: 14px;
    }
    .titulo{
      font-style: italic;
    }
    .logo{
      display: inline-block;
      
    }
    .titulos-encabezado{
      text-align: center;
      margin:auto;
    }
    .receta{
      align-self: center;
      font-style: italic;
      text-align: center;
    }
    img.logo {
    padding: 10px;
    border-radius: 40px;
    position: absolute;
    }
    .datos-doctor {
      margin: auto;
      text-align: center;
    }
    .titulo-seccion{
      background: rgb(158, 155, 155);
      font-size: 14px;
      font-weight: 700;
      padding: 0.2rem;
      margin: 0.5rem 0;
    }
    h1{
      font-size: 40px;
      color: aliceblue;
    }
    table{
      text-align: center;
    }
    td{
      /*border: 1px solid;*/
      white-space: pre-wrap;      /* CSS3 */       
      word-wrap: break-word;   
      padding: 4px;
      font-size: 15px;
    }
    th{      
      padding: 4px;
      font: bold;
      /*border: 1px solid;*/
      background: rgb(157, 207, 228);
      font-size: 15px;
    }
    .comentario{
      font-size: 12px;
      margin-left: 1rem;
    }
    .text{
      font-size: 15px;
      color: aliceblue;
      
    }
    footer{
      background-color:#056676;
      padding: 10px;
    }
    .doctor{
      font-size: 15px;
    }
    .pie{
      font-size: 13px;
    }
    .paciente{
      font-size: 20px;
    }
  </style>
  <title>Receta</title>
</head>
<body>
  <header>
    @if ($clinica != null)
      <div class="contenedorheader">
        <!--div class="contenedor-logo"-->
          <span><img class="logo" src="{{public_path(Storage::url($clinica->logo_url))}}" width="150">
        <!--/div-->
        <div class="titulos-encabezado">
          <h1 class="receta">{{$clinica->nombre}}<br> Receta Medica</h1></span>
        </div>         
        <div class="datos-doctor">
          <span class="text"><Strong class="doctor">DR: </Strong>
            {{Auth::user()->persona->nombre}}
            {{Auth::user()->persona->apellido_paterno}}
            {{Auth::user()->persona->apellido_materno}}
          </span> 
           <br>        
          <span class="text"><Strong class="doctor">ESPECIALIDAD:{{Auth::user()->persona->doctor->especialidad->nombre}} </Strong></span><br>
          <span class="text"><Strong class="doctor">TELEFONO: </Strong>{{Auth::user()->persona->telefono}}</span><br>
        </div>
      </div>
    @else
        <div class="titulos-encabezado">
          <h1 class="titulo">Receta Medica</h1>
        </div>
    @endif

  </header>

  <main>
    <span class="texto"><Strong class="paciente">Nombre de paciente: </Strong>{{$receta->hoja_consulta->consulta->cita->paciente->persona->nombre}} {{$receta->hoja_consulta->consulta->cita->paciente->persona->apellido_paterno}} {{$receta->hoja_consulta->consulta->cita->paciente->persona->apellido_materno}}</span><br>
    <span class="texto"><Strong class="paciente">Fecha de creacion: </Strong>{{$receta->updated_at}}</span><br>
    <div class="tab" style="margin: 30px auto 100px;">
      <table style="border: hidden" id="d" width="100%" cellspacing="0">
        <tr style="border: hidden">
              <th>Nro</th>
              <th>Medicamento</th>
              <th>Dosis</th>
              <th>Frecuencia</th>
              <th>Cantidad</th>    
                
          </tr>

          @php
              $i = 1;
          @endphp
         @foreach ($receta->medicamentoReceta as $medrec)
         <tr>
             <td>{{$i++}}</td>
             <td>{{$medrec->medicamento->descripcion}}-{{$medrec->medicamento->cantidad_por_unidad}}</td>
             <td>{{$medrec->dosis}}</td>
             <td>{{$medrec->frecuencia}}</td>
             <td>{{$medrec->cantidad_total}}</td>
         </tr>
         @endforeach
         
      </table>
  </div>

    <footer>
      <span class="text"><Strong class="pie">Impreso el: </Strong>{{$mytime->toDateTimeString()}}</span><br>
      <span class="text"><Strong class="pie">Por: </Strong>
        {{Auth::user()->persona->nombre}}
        {{Auth::user()->persona->apellido_paterno}}
        {{Auth::user()->persona->apellido_materno}}
      </span><br>
    </footer>
  </main>
</body>
</html>