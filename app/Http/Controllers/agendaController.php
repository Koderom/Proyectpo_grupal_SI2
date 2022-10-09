<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use App\Models\cupo;
use App\Models\doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Comment\Doc;
use Symfony\Contracts\Service\Attribute\Required;

class agendaController extends Controller
{
    public function index(){
        $Doctores = doctor::all();
        return view('Agenda.index',['Doctores'=>$Doctores]);
    }
    public function show(doctor $doctor){
        $Agendas = agenda::where('doctor_id','=',$doctor->id)->orderBy('fecha','desc')->get();
        //$Agendas = $doctor->agenda->orderby('fecha');
        return view('Agenda.show',[
            'doctor'=>$doctor,
            'Agendas'=>$Agendas
        ]);
    }
    public function create(doctor $doctor){
        return view('Agenda.create',['doctor'=>$doctor]);
    }
    public function store(Request $request,doctor $doctor){
        $agenda = new agenda();
        $agenda->fecha = $request->input('fecha_agendar');
        $agenda->doctor_id = $doctor->id;
        $agenda->save();
        $cant_cupos = $request->input('cantidad_cupos');
        for($cantidad = 0; $cantidad < $cant_cupos; $cantidad++){
            $cupo = new cupo();
            $cupo->estado = 'D';
            $cupo->hora_inicio = $request->input('hora_inicio');
            $cupo->hora_fin = $request->input('hora_fin');
            $cupo->agenda_id = $agenda->id;
            $cupo->save();
        }
        $Agendas = agenda::where('doctor_id','=',$doctor->id)->orderBy('fecha','desc')->get();
        return redirect()->route('agenda.show',['doctor'=>$doctor,'Agendas'=>$Agendas]);
    }
    public function verCupos(doctor $doctor, agenda $agenda){
        $Cupos = cupo::where('agenda_id','=',$agenda->id)->orderBy('id')->get();
        return view('Agenda.ver-cupos',['doctor'=>$doctor, 'agenda'=>$agenda, 'Cupos'=>$Cupos]);
    }


}
