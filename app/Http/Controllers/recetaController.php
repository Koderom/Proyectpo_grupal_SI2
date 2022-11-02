<?php

namespace App\Http\Controllers;

use App\Models\receta;
use Illuminate\Http\Request;

class recetaController extends Controller
{
    //
    public function store(Request $request)
    {   
        $receta = new receta();
        //$receta->hoja_consulta_id = $hoja_consulta->id;
        //$receta->expediente_id = $expediente->id;
        $receta->save();
    }
}
