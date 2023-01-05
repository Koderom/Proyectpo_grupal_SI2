@extends('layouts.template')

@section('header')
    Resultados
@endsection

@section('content')
<form action="{{route('paciente.res')}}" method="GET">
@csrf
<label for="id_paciente">Introduzca ID Paciente</label>
    <form action="{{ route('paciente.res') }}" method="GET">
        @csrf
        <label for="id_paciente">Introduzca ID Paciente</label>
        <br>
        <input type="numeric" name="ci">
        <br>
        <br>
        <button type="submit" class="mx-5">Buscar</button>
    </form>


    @if (is_null($pacientes))
    {{-- @dd($pacientes) --}}
    @else

        <div class="  grid grid-cols-1 sm:grid-cols-5 mt-5 mx-5 ">
            <!-- Options -->
            <div class="bg-white sm:col-span-3">
                <p class="bg-gray-300 p-3 font-bold text-black">
                    Resultado de Paciente
                </p>
                <table class="uppercase table-auto w-full text-black ">
                    <tbody class="">

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Nombre del Paciente:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->nombre }}  {{ $pacientes->apellido_paterno }}  {{ $pacientes->apellido_materno }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Cedula de Identidad:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->ci }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Edad:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->edad }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Fecha de Nacimiento:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->fecha_nacimiento }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Sexo:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                @if ($pacientes->sexo == 'M')
                                    Masculino
                                @else
                                    Femenino
                                @endif
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Telefono:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->telefono }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Dirección:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->direccion }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Tutor:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->nombre_tutor }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Tutor Telefono:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->numero_telefono_tutor }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Codigo de Registro:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $pacientes->codigo_registro }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Sintomas:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                cargando...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    @endif
@endsection
