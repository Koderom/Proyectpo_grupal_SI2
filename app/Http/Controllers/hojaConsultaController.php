<?php

namespace App\Http\Controllers;

use App\Models\cita;
use App\Models\consulta;
use App\Models\expediente;
use App\Models\paciente;
use App\Models\persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class hojaConsultaController extends Controller
{
    //
    public function index()
    { 
        
        $personaUsuario = Auth::user()->persona;
        $doctor = $personaUsuario->doctor;
        $consulta = consulta::where('doctor_id','=',$doctor->id)->orderBy('id', 'desc')->first();
        $citaactual = cita::where('id','=', $consulta->cita_id)->first();
        $pacienteCita= paciente::where('id','=',$citaactual->paciente_id)->get();
        $datosPaciente= persona::where('id','=',$pacienteCita[0]->persona_id)->get(); 
        $expediente = expediente::where('id','=',$datosPaciente[0]->id)->get();
        echo $expediente[0];
        exit; 
        return view('Hoja_de_consulta.index',['doctor'=>$doctor,'consulta'=>$consulta,
        'citaactual'=>$citaactual,'pacienteCita'=>$pacienteCita,'datosPaciente'=>$datosPaciente]);
    }
    //
    /*public function create()
    {
        return view('Hoja_de_consulta.create');
    }*/
}
