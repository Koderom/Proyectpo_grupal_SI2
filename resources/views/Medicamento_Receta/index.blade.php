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
                    <h4 class="col-auto">Medico: <strong>Leonor O'Keefe Sr.</strong></h4>
                </div>
                <div class="col-sm-6">
                    <!--label for="fecha_agendar">Cita:1-</label-->
                    <h4 class="col-auto">Cita: <strong>1-Brant Schamberger</strong></h4>
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
                    <tr>
                        <td>1</td>
                        <td>Azitromicina-500gr</td>
                        <td>1c</td>
                        <td>24hrs</td>
                        <td>5</td>
                        <td>
                            <form action="#"
                                method="post">
                                @csrf
                                @method('delete')
                                <a href="#"
                                    class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                                <a href="#"
                                    class="btn btn-primary btn-sm fas fa-edit  cursor-pointer"></a>
                                <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                    onclick="return confirm('¿ESTA SEGURO QUE DESEA ELIMINAR?')" value="Borrar">
                                </button>
                            </form>
                        </td>
                    </tr>

                    @php
                        $i = 1;
                    @endphp
                    @foreach ($medicamentos_receta as $medrec)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$medrec->medicamento_id}}</td>
                        <td>{{$medrec->dosis}}</td>
                        <td>{{$medrec->frecuencia}}</td>
                        <td>{{$medrec->cantidad_total}}</td>
                        <td>
                            <form action="#"
                                method="post">
                                @csrf
                                @method('delete')
                                <a href="#"
                                    class="btn btn-info btn-sm fas fa-eye cursor-pointer"></a>
                                <a href="#"
                                    class="btn btn-primary btn-sm fas fa-edit  cursor-pointer"></a>
                                <button class="btn btn-danger btn-sm fas fa-trash-alt  cursor-pointer"
                                    onclick="return confirm('¿ESTA SEGURO QUE DESEA ELIMINAR?')" value="Borrar">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
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
            <form action="#" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="col-xs-6 col-sm-6 col-md-12 mt-3">
                        <label style="color: #0b1949" for="ci" class="form-label la">Medicamento:</label>
                        <select name="medicamento" id="medicamento" class="form-control shadow-sm" required>
                            @foreach ($medicamentos as $medicamento)
                                <option {{ old('descripcion') == $medicamento->id ? 'selected' : ' ' }}
                                    value="{{ $medicamento->id }} ">{{ $medicamento->descripcion }}-{{$medicamento->cantidad_por_unidad}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group " style="display: flex;">
                        <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                            <label style="color: #061030" for="cantidad" class="form-label la">Dosis</label>
                            <input name="cantidad" type="text" class="form-control
                            shadow-sm"
                                id="cantidad" for="cantidad" value="{{ old('cantidad') }}">
                            @error('cantidad')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                            <label style="color: #061030" for="cantidad" class="form-label la">Frecuencia</label>
                            <input name="cantidad" type="text" class="form-control
                            shadow-sm"
                                id="cantidad" for="cantidad" value="{{ old('cantidad') }}">
                            @error('cantidad')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                        <label style="color: #061030" for="cantidad" class="form-label la">Cantidad</label>
                        <input name="cantidad" type="number" class="form-control
                        shadow-sm"
                            id="cantidad" for="cantidad" value="{{ old('cantidad') }}">
                        @error('cantidad')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
                    <button type="submit" class="btn btn-primary" style="background: #1cc88a; border-color: #1cc88a;">
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
            <form action="{{ route('medicamento.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-xs-6 col-sm-6 col-md-12 mt-3">
                        <label style="color: #0b1949" for="descripcion" class="form-label la">Medicamento:</label>
                        <input name="descripcion" type="text" class="form-control shadow-sm"
                                id="descripcion"  value="{{ old('descripcion') }}" required>
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
                    <button type="submit" class="btn btn-primary" style="background: #1cc88a; border-color: #fbaf32;">
                        Aceptar
                    </button>
                </div>
                <br>
            </form>

        </div>
    </div>
</div>
@endsection