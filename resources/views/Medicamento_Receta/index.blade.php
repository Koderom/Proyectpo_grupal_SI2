@extends('layouts.template')

@section('header')Receta @endsection

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 style="text-align: center;">Receta Medica</h2>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <!--label for="fecha_agendar">Medico:</label-->
                    <h4 class="col-auto">Medico: <strong>{{$receta->hoja_consulta->consulta->doctor->persona->nombre}}</strong></h4>
                </div>
                <div class="col-sm-6">
                    <!--label for="fecha_agendar">Cita:1-</label-->
                    <h4 class="col-auto">Cita: <strong>{{$receta->hoja_consulta->consulta->cita->id}}</strong></h4>
                </div>  
             </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>Medicamento</th>
                        <th>Dosis</th>
                        <th>Frecuencia</th>
                        <th>Cantidad</th>    
                        <th>Acciones</th>    
                    </tr>

                    @php
                        $i = 1;
                    @endphp
                    @foreach ($receta->medicamentoReceta as $medrec)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$medrec->medicamento->descripcion}}-{{$medrec->medicamento->cantidad_por_unidad}}</td>
                        <td>{{$medrec->dosis}}</td>
                        <td>{{$medrec->frecuencia}}</td>
                        <td>{{$medrec->cantidad_total}}</td>
                        <td>
                            <form id="acciones" action="#"
                                method="post">
                                @csrf
                                @method('delete')
                                <a href="#"
                                    class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                                <a href="#"
                                    class="btn btn-primary btn-sm fas fa-edit  cursor-pointer"></a>
                                <button form='acciones' class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                    onclick= " return confirm('¿ESTA SEGURO QUE DESEA ELIMINAR?')"  value="Borrar">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="">
            <form action="{{route('receta.medicamento.pdfGenerate',['receta_id'=>$receta->id])}}" id="generarPDF" method="get">
                @method('get')
                @csrf
                <button type="submit" class="btn btn-sm btn-light float-right" data-toggle="modal" data-target="#exampleModalCenterTitle"
                style="background-color:#f6c23e; margin: 0px 10px; padding: 10px 40px; border-radius: 12px; font-size: large;">
                <span><i class="fas fa-download fa-sm text-white-50"></i></span>Generar PDF
                </button>
            </form>
        </div>
        <div class="">
            <button type="button" class="btn btn-sm btn-light float-right" data-toggle="modal" data-target="#exampleModalCenterTitle"
            style="background-color:#1cc88a; margin: 15px 10px; padding: 10px 40px; border-radius: 12px; font-size: large;">
            <span>
                <i class="fa fa-plus " style="color: #f8f8f8"></i>
            </span>
                Agregar Medicamento
            </button>  
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0">
            <a href="{{ route('hojaconsulta.index') }}"
                class="btn btn-primary btn-user btn-block">
                Atras
            </a>
        </div>
    </div> 
</div>

<div class="modal fade" id="exampleModalCenterTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c4f66; color: white">
                <h5 class="modal-title" id="exampleModalLongTitle">Medicamento Receta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="medrec" action="{{route('receta.medicamento.store')}}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="col-xs-6 col-sm-6 col-md-12 mt-3">
                        <label style="color: #0b1949" for="ci" class="form-label la">Medicamento:</label>
                        <select name="medicamento_id" id="medicamento" class="form-control shadow-sm" required>
                            @foreach ($medicamentos as $medicamento)
                                <option {{ old('medicamento_id') == $medicamento->id ? 'selected' : ' ' }}
                                    value="{{ $medicamento->id }} ">{{ $medicamento->descripcion }}-{{$medicamento->cantidad_por_unidad}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="receta_id" value="{{$receta->id}}">
                    </div>
                    <div class="form-group " style="display: flex;">
                        <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                            <label style="color: #061030" for="dosis" class="form-label la">Dosis</label>
                            <input name="dosis" type="text" class="form-control shadow-sm"
                                id="cantidad" for="dosis" value="{{ old('dosis') }}">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                            <label style="color: #061030" for="frecuencia" class="form-label la">Frecuencia</label>
                            <input name="frecuencia" type="text" class="form-control shadow-sm"
                                id="frecuencia" for="frecuencia" value="{{ old('frecuencia') }}">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                        <label style="color: #061030" for="cantidad_total" class="form-label la">Cantidad</label>
                        <input name="cantidad_total" type="number" class="form-control
                        shadow-sm"
                            id="cantidad" for="cantidad_total" value="{{ old('cantidad_total') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="">
                        <button type="button" class="btn btn-sm btn-light float-right" data-toggle="modal" data-target="#ModalNuevoMedicamento"
                        style="background-color:#fbaf32; margin: 0 170px 0 0; border-radius: 12px; font-size: large;">
                        <span>
                            <i class="fa fa-plus " style="color: #f8f8f8"></i>
                        </span>
                            Nuevo Medicamento
                        </button>  
                    </div>
                    <button type="submit" form="medrec" class="btn btn-primary" style="background: #1cc88a; border-color: #1cc88a;">
                        Recetar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="ModalNuevoMedicamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #1e5b5e; color: white">
                <h5 class="modal-title" id="exampleModalLongTitle"> Nuevo Medicamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
            </div>
            <form id="med" action="{{ route('medicamento.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-xs-6 col-sm-6 col-md-12 mt-3">
                        <label style="color: #0b1949" for="descripcion" class="form-label la">Medicamento:</label>
                        <input name="descripcion" type="text" class="form-control shadow-sm"
                                id="descripcion"  value="{{ old('descripcion') }}" required>
                        <input type="hidden" name="recetaid" value="{{$receta->id}}">
                    </div>
                    <br>
                    <!--div class="form-group row"-->
                        <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                            <label style="color: #061030" for="cantidad_por_unidad" class="form-label la">Cantidad por unidad:</label>
                            <input name="cantidad_por_unidad" type="text" class="form-control
                            shadow-sm" id="cantidad" value="{{ old('cantidad_por_unidad') }}" required>
                            @error('cantidad')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    <!--/div-->
                    <br>
                </div>
                <div class="modal-footer">
                    <br>
                    <button type="submit" form="med" class="btn btn-primary" style="background: #1cc88a; border-color: #fbaf32;">
                        Aceptar
                    </button>
                </div>
                <br>
            </form>

        </div>
    </div>
</div>
@endsection
