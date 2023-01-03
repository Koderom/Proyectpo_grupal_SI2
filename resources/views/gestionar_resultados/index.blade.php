@extends('layouts.template')

@section('header')Resultados @endsection

@section('content')
<form action="{{route('paciente.res')}}" method="GET">
@csrf
<label for="id_paciente">Introduzca ID Paciente</label>
<br>
<input type="numeric" name="id_paciente">
<br>
<br>
<button type="submit" class="mx-5">Buscar</button>
</form>

@forelse ($pas as $p)
<p>{{$p->id}}</p>
@empty
@endforelse

@endsection
