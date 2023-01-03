<?php

namespace App\Http\Controllers;

use App\Models\medicamento;
use App\Models\medicamento_receta;
use App\Models\receta;
use Illuminate\Http\Request;

class medicamentoRecetaController extends Controller
{
    //
    public function index(receta $receta)
    {
       // return $receta;
        // $recetas = receta::all();
         $medicamentos = medicamento::all();
        // $medicamentos_receta = medicamento_receta::all();
        return view('Medicamento_Receta.index',['receta'=>$receta, 'medicamentos'=>$medicamentos]);

    }
    public function store(Request $request)
    {   
        $medicamentoreceta = new medicamento_receta();
        $medicamentoreceta->cantidad_total = $request->cantidad_total;
        $medicamentoreceta->frecuencia = $request->frecuencia;
        $medicamentoreceta->dosis = $request->dosis;
        $medicamentoreceta->receta_id = $request->receta_id;
        $medicamentoreceta->medicamento_id = $request->medicamento_id;
        $medicamentoreceta->save();
        return  redirect()->route('receta.medicamento.index',[$medicamentoreceta->receta_id]);
    }
    
    //ver receta
    public function show($hojaconsulta_id)
    {
        $receta= receta::find($hojaconsulta_id);
        $medicamentos = medicamento::all();
        return view('Medicamento_Receta.show', $receta,['receta'=>$receta, 'medicamentos'=>$medicamentos]);
    }
}
