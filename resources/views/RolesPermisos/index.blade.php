<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roles y permisos</title>
</head>
<body>
    <h2>Permisos disponibles</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
        </tr>
        @foreach ($Permisos as $permiso)
        <tr>
            <td>{{$permiso->id}}</td>
            <td>{{$permiso->name}}</td>
        </tr>
        @endforeach
    </table>
    <h2>Roles disponibles</h2>
    <a href="{{ route('roles.create') }}">Crear nuevo rol</a>
    <a href="{{ route('roles.asignar-rol') }}">Asignar rol a usuario</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Opciones</th>
        </tr>
        @foreach ($Roles as $rol)
        <tr>
            <td>{{$rol->id}}</td>
            <td>{{$rol->name}}</td>
            <td>
                <a href="{{ route('roles.show', ['rol'=> $rol]) }}">ver permisos</a>
                <a href="{{ route('roles.edit', ['rol'=> $rol]) }}">editar</a>
                <a href="{{ route('roles.destroy', ['rol'=> $rol]) }}">eliminar</a>
            </td>
        </tr>
        @endforeach
    </table>

        
    
</body>
</html>