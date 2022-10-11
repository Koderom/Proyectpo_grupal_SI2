@extends('layouts.template')

@section('header')Reservar Cita @endsection

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
                        <label for="cupo">Seleccionar horario</label>
                        <select name="cupo" id="cupo" class="form-control">
                            @foreach ($Cupos as $cupo)
                                <option value="{{$cupo->id}}">{{$cupo->hora_inicio}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo de solicitud de la cita (opcional):</label>
                        <textarea class="form-control" name="motivo" id="motivo" cols="30" rows="2">

                        </textarea>
                    </div>
                    </div class="container">
                        <div class="row px-3">
                            <button type="submit" class="btn btn-primary col-3">Siguiente</button>
                            <a href="{{ route('home') }}"
                                class="btn btn-danger btn-user btn-block col-3">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection