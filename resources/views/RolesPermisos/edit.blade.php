<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Editar persmisos de {{$rol->name}}</h1>
    <form action="{{route('roles.update',['rol'=>$rol])}}" method="POST">
        @csrf
        @foreach ($Permisos as $permiso)
            @if ($rol->hasPermissionTo($permiso))
            <label><input type="checkbox" name="permisos[]" value="{{$permiso->id}}" checked>{{$permiso->name}}</label>
            @else
            <label><input type="checkbox" name="permisos[]" value="{{$permiso->id}}">{{$permiso->name}}</label>
            @endif
            <br>
        @endforeach
        <input type="submit">
        <a href="{{route('roles.index')}}">cancelar</a>
    </form>
</body>
</html>