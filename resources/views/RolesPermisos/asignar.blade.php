<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Asignar Roles a Usuarios</h1>
    <form action="{{route('roles.store-asignar-rol')}}" method="post">
        @csrf
        <select name="usuario" id="usuario">
            @foreach ($Usuarios as $usuario)
            <option value="{{$usuario->id}}">{{$usuario->name}}</option>
            @endforeach
        </select>
        <select name="rol" id="rol">
            @foreach ($Roles as $rol)
                <option value="{{$rol->id}}">{{$rol->name}}</option>
            @endforeach
        </select>
        <input type="submit">
        <a href="{{route('roles.index')}}">cancelar</a>
    </form>
</body>
</html>