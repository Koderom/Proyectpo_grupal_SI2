<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Crear nuevo Rol</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <label for="rol_nombre">Introducir un nombre para el rol</label>
        <input type="text" name="rol_nombre" id="rol_nombre" value="{{old('rol_nombre')}}"><br>
        @error('rol_nombre')
            <small>{{$message}}</small>
        @enderror
        @foreach ($Permisos as $permiso)
            <label><input type="checkbox" name="permisos[]" value="{{$permiso->id}}">{{$permiso->name}}</label>    <br>
        @endforeach
        <input type="submit">
        <a href="{{route('roles.index')}}">cancelar</a>
    </form>
</body>
</html>