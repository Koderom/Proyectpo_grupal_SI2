<?php

namespace App\Http\Controllers;

use App\Models\receta;
use Illuminate\Http\Request;

class recetaController extends Controller
{
    
    
    public function store(Request $request, $hojaconsultaid, $expedienteid)
    {  
        $receta = new receta();
        $receta->hoja_consulta_id = $hojaconsultaid;
        $receta->expediente_id = $expedienteid;
        $receta->save();
        return redirect()->route('receta.medicamento.index',['receta'=>$receta]);
    }
}
