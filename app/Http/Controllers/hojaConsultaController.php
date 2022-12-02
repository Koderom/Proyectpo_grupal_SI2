<?php

namespace App\Http\Controllers;

use App\Models\cita;
use App\Models\consulta;
use App\Models\expediente;
use App\Models\hoja_consulta;
use App\Models\paciente;
use App\Models\persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class hojaConsultaController extends Controller
{
    //
    public function index()
    { 
        $hojaconsultas = hoja_consulta::all();
        return view('Hoja_de_consulta.index',['hojaconsultas'=>$hojaconsultas]);
    }
    public function create(consulta $consulta)
    { //return $consulta;
    //    $personaUsuario = Auth::user()->persona;
    //     $doctor = $personaUsuario->doctor;
    //     $consulta = consulta::where('doctor_id','=',$doctor->id)->orderBy('id', 'desc')->first();
    //     $citaactual = cita::where('id','=', $consulta->cita_id)->first();
    //    $pacienteCita= paciente::where('id','=',$citaactual->paciente_id)->get();
    //     $datosPaciente= persona::where('id','=',$pacienteCita[0]->persona_id)->get(); 
    //     $expediente = expediente::where('id','=',$datosPaciente[0]->id)->get();
        return view('Hoja_de_consulta.create',['consulta'=>$consulta]);
    }
    //
    public function store(Request $request)
    { 
        $request->validate([
            'sintomas'=>'required',
            'impresion_diagnostica'=>'required',
            'indicaciones_medica'=>'required',
            'proxima_consulta'=>'required',
        ]);
        $hojaconsulta = new hoja_consulta();
        $hojaconsulta->sintomas = $request->sintomas;
        $hojaconsulta->impresion_diagnostica = $request->impresion_diagnostica;
        $hojaconsulta->indicaciones_medica = $request->indicaciones_medica;
        $hojaconsulta->proxima_consulta = $request->proxima_consulta;
        $hojaconsulta->consulta_id = $request->consulta_id;
        $hojaconsulta->expediente_id = $request->expediente_id;
        $hojaconsulta->save();
        return redirect()->route('hojaconsulta.index');
    }

//ver hoja de consulta
 /*public function show($hojaconsulta_id)
 {
    $hojaconsulta= hoja_consulta::find($hojaconsulta_id);
    return view('Hoja_de_consulta.show', $hojaconsulta);
 }
*/

}
