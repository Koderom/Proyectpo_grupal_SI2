@extends('layouts.template')

@section('content')
 <h1>
    Bienvenido <strong>
        {{Auth::user()->persona->nombre}}
        {{Auth::user()->persona->primer_apellido}}
        {{Auth::user()->persona->segundo_apellido}}
    </strong>
 </h1>
@endsection