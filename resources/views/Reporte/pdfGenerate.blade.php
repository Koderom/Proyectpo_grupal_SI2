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
    }
    .titulo{
      padding: 0;
      margin: 1rem auto;
      text-align: center;
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
    h1{
      font-size: 20px;
    }
    table{
      margin: 5rem 1rem;
      width: 90%;
      border-collapse: collapse;
    }
    td{
      border: 1px solid;
      white-space: pre-wrap;      /* CSS3 */       
      word-wrap: break-word;   
      padding: 4px;
    }
    th{      
      padding: 4px;
      font: bold;
      border: 1px solid;
      background: rgb(157, 207, 228);
    }
    .comentario{
      font-size: 12px;
      margin-left: 1rem;
    }
    .text{
      font-size: 12px;
    }
  </style>
  <title>Document</title>
</head>
<body>
  <header>
    @if ($clinica != null)
    <img class="logo" src="{{public_path(Storage::url($clinica->logo_url))}}" width="200">
    <div class="titulos-encabezado">
      <h1 class="titulo">{{$clinica->nombre}}</h1>
      <h1 class="titulo">{{$titulo}}</h1>
    </div>    
    @else
    <div class="titulos-encabezado">
      <h1 class="titulo">{{$titulo}}</h1>
    </div>
    @endif
  </header>
  <main>
    @if ($formulario->comentario != null)
      <strong class="text">Comentario: </strong>
      <br>
      <p class="comentario">  
        {{$formulario->comentario}}
      </p>
    @endif
    <table>
      <thead>
        <tr>
          @foreach ($Columnas as $columna)
            <th>{{$columna}}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($tablaContenido as $fila)
          <tr>
            @foreach ($Columnas as $columna)
              <td><span>{{collect($fila)->get($columna)}}</span></td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
    <footer>
      <span class="text"><Strong>Reporte creado el: </Strong>{{$myTime->toDateTimeString()}}</span><br>
      <span class="text"><Strong>Por: </Strong>
        {{Auth::user()->persona->nombre}}
        {{Auth::user()->persona->apellido_paterno}}
        {{Auth::user()->persona->apellido_materno}}
      </span><br>
    </footer>
  </main>
</body>
</html>