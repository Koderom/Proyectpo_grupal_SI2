<?php

namespace App\Http\Controllers;

use App\Models\medicamento;
use App\Models\medicamento_receta;
use App\Models\receta;
use Illuminate\Http\Request;

class medicamentoRecetaController extends Controller
{
    //
    public function index()
    {
        $recetas = receta::all();
        $medicamentos = medicamento::all();
        $medicamentos_receta = medicamento_receta::all();
        return view('Medicamento_Receta.index',['recetas'=>$recetas,'medicamentos'=>$medicamentos,'medicamentos_receta'=>$medicamentos_receta]);
        
    }
    public function store(Request $request)
    {   
        /*$consulta = new consulta();
        //$consulta->doctor_id = $doctor->id;
        //$consulta->cita_id = $cita->id;
        $consulta->save();*/
    }
}
