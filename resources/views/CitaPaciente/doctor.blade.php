@extends('layouts.template')

@section('header')Seleccionar doctor @endsection

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
                <form  action="{{route('cita.paciente.reservar.agenda')}}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="doctor">Doctores Disponibles</label>
                        <select name="doctor" id="doctor" class="form-control">
                            @foreach ($Doctores as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->persona->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                      <button type="submit" class="btn btn-primary">Continuar</button>
                </form>
            </div>
        </div>
    </div>
@endsection