<?php

namespace App\Http\Controllers;

use App\Models\clinica;
use App\Models\medicamento;
use App\Models\medicamento_receta;
use App\Models\receta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function pdfGenerate($receta_id){

           $mytime = Carbon::now('America/La_Paz');
           $clinica = clinica::first();
           $medicamentos = medicamento::all();
           $receta= receta::find($receta_id);
            $pdf = Pdf::loadView('Medicamento_Receta.pdfGenerate',[
                'receta' => $receta,
                'medicamentos' => $medicamentos,
                'clinica' => clinica::first(),
                'mytime' => $mytime
            ]);
            //return view('Medicamento_Receta.pdfGenerate',['clinica'=>$clinica, 'medicamentos'=> $medicamentos,'receta'=> $receta,'mytime'=> $mytime,]);
            
            return $pdf->download();
    }
}
