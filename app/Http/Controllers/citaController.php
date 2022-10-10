<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use App\Models\cita;
use App\Models\cupo;
use App\Models\doctor;
use App\Models\especialidad;
use App\Models\paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class citaController extends Controller
{
    public function create(cupo $cupo){
        $Pacientes = paciente::all();
        return view('Cita.create',['cupo'=>$cupo, 'Pacientes'=>$Pacientes]);
    }
    public function store(Request $request, cupo $cupo){
        $cita = new cita();
        $cita->motivo = $request->input('motivo');
        $cita->fecha_cita = $cupo->agenda->fecha;
        $cita->hora_cita = $cupo->hora_inicio;
        $cita->confirmado = false;
        $cupo->estado = 'R';
        $cupo->update();
        $cita->cupo_id = $cupo->id;
        $cita->administrativo_id = '1'; //resolver usuario autenticado Auth
        $doctor = $cupo->agenda->doctor;
        $cita->especialidad_id = $doctor->especialidad->id;
        $cita->doctor_id = $doctor->id;
        $cita->paciente_id = $request->input('paciente');
        $cita->save();
        $agenda = $cupo->agenda;
        return redirect()->route('agenda.ver-cupos',['agenda'=>$agenda, 'doctor'=>$doctor]);
        //return view('Agenda.ver-cupos',['doctor'=>$doctor, 'agenda'=>$agenda, 'Cupos'=>$Cupos]);
    }
    public function confirmarCita(cupo $cupo){
        $cupo->estado = 'C';
        $cita = $cupo->cita;
        $cita->administrativo_id = '1';
        $cita->confirmado = true;
        $agenda = $cupo->agenda;
        $doctor = $agenda->doctor;
        $cita->save();
        $cupo->save();
        return redirect()->route('agenda.ver-cupos',['agenda'=>$agenda, 'doctor'=>$doctor]);
    }
    public function show(Cupo $cupo){
        return view('Cita.show',['cupo'=>$cupo]);
    }
    public function reservarCitaPaciente(){
        $Especialidades = especialidad::all();
        return view('CitaPaciente.especialidad',['Especialidades'=>$Especialidades]);
    }
    public function seleccionarEspecialidad(Request $request){
        $especialidad = especialidad::find($request->input('especialidad')); 
        return redirect()->route('cita.paciente.reservar.doctor',['especialidad'=>$especialidad]);
    }
    public function verDoctorEspecialidad(especialidad $especialidad){
        $Doctores = $especialidad->doctor;
        return view('CitaPaciente.doctor',['Doctores'=>$Doctores]);
    }
    public function verAgenda(Request $request){
        $doctor = doctor::find($request->input('doctor'));
        $Agendas = $doctor->agenda;
        return view('CitaPaciente.agenda',['Agendas'=>$Agendas]);
    }
    public function verCupo(Request $request){
        $agenda = agenda::find($request->input('agenda'));
        $Cupos = $agenda->cupo->where('estado','=','D');
        return view('CitaPaciente.cupo',['Cupos'=>$Cupos]);
    }
    public function confirmarReserva(Request $request){
        $cupo = cupo::find($request->input('cupo'));
        $cita = new cita();
        $cita->fecha_cita = $cupo->agenda->fecha;
        $cita->hora_cita = $cupo->hora_inicio;
        $cita->confirmado = false;
        $cita->motivo = $request->input('motivo');
        $cupo->estado = 'R';
        $cita->cupo_id = $cupo->id;
        $cita->paciente_id = '1';//arreglas el inicio de sesion
        $cita->especialidad_id = $cupo->agenda->doctor->especialidad_id;
        $cita->doctor_id = $cupo->agenda->doctor->id;
        $cupo->update();
        $cita->save();
        return redirect()->route('menu');
        
    }
    public function verAgendaMedico(){
        if(request()->input('fecha')!=null) $fecha = request()->input('fecha');
        else {
            $mytime= Carbon::now('America/La_Paz'); 
            $fecha = $mytime->toDateString();
        }
        $doctor = doctor::find('1');
        $agenda = agenda::where('fecha','=',$fecha)->where('doctor_id','=',$doctor->id)->first();
        if($agenda == null) $agenda = agenda::where('doctor_id','=',$doctor->id)->first();
        $Cupos = cupo::where('agenda_id','=',$agenda->id)->orderBy('id')->get();
        return view('CitaDoctor.verAgenda',['doctor'=>$doctor, 'agenda'=>$agenda, 'Cupos'=>$Cupos]);
    }
    public function verMisCitas(){
        $paciente = paciente::find(1);
        $misCitas = $paciente->cita;
        return view('CitaPaciente.misCitas',['Citas'=>$misCitas, 'paciente'=>$paciente]);
    }
}
;