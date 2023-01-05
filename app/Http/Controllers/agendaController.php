<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use App\Models\cupo;
use App\Models\doctor;
use App\Models\turno;
use App\Models\turnoDoctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Comment\Doc;
use Symfony\Contracts\Service\Attribute\Required;

use function PHPUnit\Framework\returnSelf;

class agendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $request->validate([
            'fecha_agendar'=>'required',
            'cantidad_cupos'=>'required',
            'hora_inicio'=>'required',
            //'hora_fin'=>'required',
            'minutos'=>'required',
        ]);
        /*------------Validaciones-------------- */
        $Dias = collect(['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo']);
        $fechaParaAgendar = Carbon::createFromDate($request->input('fecha_agendar'));
        $hoy = Carbon::now('America/La_Paz');
        $indiceDia = $fechaParaAgendar->weekday();
        $diaParaAgendar = $Dias[$indiceDia];
        $existeDia = turnoDoctor::where('doctor_id',$doctor->id)->where('dia_atencion',$diaParaAgendar)->get();
        if($existeDia->isEmpty()) return "El doctor no tiene asignado un turno para este dia";
        $existeAgenda = agenda::where('doctor_id',$doctor->id)->where('fecha',$fechaParaAgendar->toDateString())->get();
        if(!$existeAgenda->isEmpty()) return "El doctor ya tiene una agenda para este dia";
        $turno = turno::where('id',$existeDia->first()->turno_id)->first();
        $fechaComodin =  $hoy->toDateString();

        $fechaInicioTurno = Carbon::createFromFormat('Y-m-d H:i:s.u', $fechaComodin.' '.$turno->hora_inicio.'.000000');
        $fechaInicioTurno2 = Carbon::createFromFormat('Y-m-d H:i:s.u', $fechaComodin.' '.$request->input('hora_inicio').':00.000000');
        if($fechaInicioTurno->greaterThan($fechaInicioTurno2)) return "El horario de comienzo de atencion es menor al horario de ingreso del doctor";
        $hora_ini = Carbon::createFromTimeString($turno->hora_inicio);
        $hora_fn = Carbon::createFromTimeString($turno->hora_fin);
        if($hora_ini->greaterThan($hora_fn)) $hora_fn->addDay(1);
        $horas_trabajo = $hora_ini->diffInHours($hora_fn,false);
        $minutos_trabajo = $horas_trabajo*60;
        $minutos_citas = $request->input('cantidad_cupos')*$request->input('minutos');
        if($minutos_trabajo<$minutos_citas) return "los minutos y cantidad de cupos superan el horario de trabajo del medico";
        
        /*-----------------------------------*/
        $format = 'Y-m-d H:i';
        $time = $request->input('fecha_agendar').' '.$request->input('hora_inicio');
        $fechaHoraAgendar = Carbon::createFromFormat($format,$time);
        //------------------------------------
        $agenda = new agenda();
        $agenda->fecha = $fechaHoraAgendar->toDateString();
        $agenda->doctor_id = $doctor->id;
        $agenda->save();
        $cant_cupos = $request->input('cantidad_cupos');
        $cant_minutos = $request->input('minutos');
        for($cantidad = 0; $cantidad < $cant_cupos; $cantidad++){
            $cupo = new cupo();
            $cupo->estado = 'D';
            $cupo->hora_inicio = $fechaHoraAgendar->toTimeString();
            $fechaHoraAgendar->addMinutes($cant_minutos);
            $cupo->hora_fin = $fechaHoraAgendar->toTimeString();
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
