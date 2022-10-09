@extends('layouts.template')

@section('header')Fechas Disponibles @endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg p-3 mb-5 bg-white" style="border-radius: 1rem">
            <div class="card-body ">
                {{ csrf_field() }}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form  action="{{route('cita.paciente.reservar.cupo')}}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="agenda">Selecciones una Fecha</label>
                        <select name="agenda" id="agenda" class="form-control">
                            @foreach ($Agendas as $agenda)
                                <option value="{{$agenda->id}}">{{$agenda->fecha}}</option>
                            @endforeach
                        </select>
                    </div>
                      <button type="submit" class="btn btn-primary">Ver Cupos</button>
                </form>
            </div>
        </div>
    </div>
@endsection