@extends('layouts.template')

@section('header')Seleccionar Horario @endsection

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
                <form  action="{{route('cita.paciente.reservar.confirmar')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cupo">Horarios disponibles</label>
                        <select name="cupo" id="cupo" class="form-control">
                            @foreach ($Cupos as $cupo)
                                <option value="{{$cupo->id}}">{{$cupo->hora_inicio}}</option>
                            @endforeach
                        </select>
                    </div>
                      <button type="submit" class="btn btn-primary">Confirmar reserva</button>
                </form>
            </div>
        </div>
    </div>
@endsection