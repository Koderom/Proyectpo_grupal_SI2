<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>{{$rol->name}}</h3>
    <ul>
        @foreach ($Permisos as $permiso)
            <li>{{$permiso->name}}</li>
        @endforeach
    </ul>
    <a href="{{route('roles.index')}}">Atras</a>
</body>
</html>