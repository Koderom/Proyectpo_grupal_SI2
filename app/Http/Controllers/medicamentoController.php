<?php

namespace App\Http\Controllers;

use App\Models\medicamento;
use Illuminate\Http\Request;

class medicamentoController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'descripcion'=>'required',// puede haber nombre de medicamento repetido?
            'cantidad_por_unidad'=>'required',
        ]);
        $medicamento = new medicamento();
        $medicamento->descripcion = $request->descripcion;
        $medicamento->cantidad_por_unidad = $request->cantidad_por_unidad;
        $medicamento->save();
        return redirect()->route('receta.medicamento.index');
    }
}
