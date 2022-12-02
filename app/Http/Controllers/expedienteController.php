<?php

namespace App\Http\Controllers;

use App\Models\expediente;
use App\Models\paciente;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class expedienteController extends Controller
{
    public function expedientePaciente(paciente $paciente){
        $expediente = expediente::where('paciente_id',$paciente->id)->first();
        if($expediente == null) return "no se encontro";
        return view('ExpedienteClinico.Paciente.index',[
            'paciente' => $paciente,
            'expediente' => $expediente
        ]);
    }
}
