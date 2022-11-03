<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use App\Models\cita;
use App\Models\consulta;
use App\Models\cupo;
use App\Models\doctor;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class consultaController extends Controller
{
    //
    public function index()
    {
        if(request()->input('fecha')!=null) $fecha = request()->input('fecha');
        else {
            $mytime= Carbon::now('America/La_Paz'); 
            $fechaActual = $mytime->toDateString();
        }
        $personaUsuario = Auth::user()->persona;
        if($personaUsuario->tipo[0] != 'D') return "Error";
        $doctor = $personaUsuario->doctor;
        $agenda = agenda::where('fecha','=',$fechaActual)->where('doctor_id','=',$doctor->id)->first();
        /*validar si el doctor no tiene citas*/
        if($agenda == null) $agenda = agenda::where('doctor_id','=',$doctor->id)->first();
       // $Cupos = cupo::where('agenda_id','=',$agenda->id)->orderBy('id')->get();
        $Citas = cita::where('doctor_id','=',$doctor->id)->where('fecha_cita','=',$fechaActual)->orderBy('hora_cita')->get();
     return view('consulta.index',['doctor'=>$doctor, 'agenda'=>$agenda, 'Citas'=>$Citas, 'fechaActual'=>$fechaActual]);     
    }

    public function store(Request $request, $doctorid, $citaid)
    {   
        
        $consulta = new consulta();
        $consulta->doctor_id =$doctorid;
        $consulta->cita_id = $citaid;
        $consulta->save();
        return redirect()->route('hojaconsulta.create',['consulta'=>$consulta]);
    }

}
