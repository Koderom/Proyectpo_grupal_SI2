<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\doctorQuirofano;
use App\Models\paciente;
use App\Models\reservaQuirofano;
use App\Models\sala;
use App\Models\sector;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class reservaQuirofanoController extends Controller
{
    public function create(){    
        $Pacientes = paciente::all();
        $Doctores = doctor::join('especialidads', 'especialidads.id','=','doctors.especialidad_id')
        ->select('doctors.*','especialidads.nombre as especialidad')
        ->get();
        $Salas = sala::where('tipo_sala','Q')->get();
        if($Salas->count() == 0) return redirect()->back()->withErrors('No existe ningun quirofano reservado para registrar');
        return view('Quirofano.reservar',['Pacientes'=>$Pacientes, 'Doctores'=>$Doctores, 'Salas'=>$Salas]);
    }
    public function store(Request $request){
        $request->validate([
            'paciente' => 'required',
            'quirofano' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'duracion'=> 'required',
            'doctores'=>'required'
        ]);
        //datos
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $fechaHoraReserva = Carbon::createFromFormat('Y-m-d H:i:s.u', $fecha.' '.$hora.':00.000000');
        $fechaHoraActural = Carbon::now('America/La_Paz');
        if($fechaHoraActural->greaterThan($fechaHoraReserva))return redirect()->back()->withErrors('fecha programada no valida');
        $salaQuirofano = sala::find($request->input('quirofano'));
        $paciente = paciente::find($request->input('paciente'));
        $GrupoDoctores = $request->input('doctores');
        $duracion = $request->input('duracion');
        $errores = collect([]);

        $fechaHoraSalida = Carbon::create($fechaHoraReserva)->addHours($duracion);

        if($salaQuirofano->quirofano->estaReservado($fechaHoraReserva,$fechaHoraSalida)) return back()->withErrors('Quirofano reservado a esta hora');        
        $reservaQuirofano = new reservaQuirofano();
        $reservaQuirofano->fecha_hora_entrada = $fechaHoraReserva->toDateTimeString();
        $reservaQuirofano->fecha_hora_salida = $fechaHoraSalida->toDateTimeString();
        $reservaQuirofano->cantidad_horas = $duracion;
        $reservaQuirofano->tipo_intervencion = "intervencion generica";
        $reservaQuirofano->procedimiento = "procedimiento de rutina";
        $reservaQuirofano->quirofano_id = $salaQuirofano->quirofano->id;
        $reservaQuirofano->paciente_id = $paciente->id;
        $reservaQuirofano->save();
        foreach($GrupoDoctores as $doctor){
            $doctor = explode("_", $doctor);
            $funcion = $doctor[1];
            $doctor = doctor::find($doctor[0]);
            if($funcion == null){
                $errores->push('No se pudo agregar a: '.$doctor->persona->nombre.' al grupo de cirugia, no se especifico su funcion');
                continue;
            } 
            if($doctor->tieneCirugiaProgramada($fechaHoraReserva,$fechaHoraSalida)){
                $errores->push('No se pudo agregar a: '.$doctor->persona->nombre.' al grupo de cirugia, tiene otra cirugia programada');
                continue;
            }else{
                $doctorQuirofano = new doctorQuirofano();
                $doctorQuirofano->funcion = $funcion;
                $doctorQuirofano->doctor_id = $doctor->id;
                $doctorQuirofano->reserva_quirofano_id = $reservaQuirofano->id;
                $doctorQuirofano->save();
            }
        }
        if($errores->count()>0) return redirect()->route('quirofano.index')->withErrors($errores)->with('message','quirofano reservado');
        return redirect()->route('quirofano.index')->with('message','quirofano reservado');
    }

    public function show(reservaQuirofano $reservarQuirofano){
        $doctors_id = doctorQuirofano::where('doctor_quirofanos.reserva_quirofano_id', $reservarQuirofano->id)->select('doctor_quirofanos.doctor_id')->get();
        $DoctoresDisponibles = doctor::whereNotIn('doctors.id',$doctors_id)->get();
        $DoctorQuirofanos = doctorQuirofano::where('doctor_quirofanos.reserva_quirofano_id', $reservarQuirofano->id)->get();
        return view('ReservaQuirofano.show',['reservarQuirofano'=>$reservarQuirofano, 'DoctorQuirofanos'=>$DoctorQuirofanos,'DoctoresDisponibles'=>$DoctoresDisponibles]);
    }
    public function doctorQuirofanoEliminar(doctorQuirofano $doctorQuirofano){
        $reservaQuirofano = $doctorQuirofano->reservaQuirofano;
        $doctorQuirofano->delete();
        return redirect()->route('reservarQuirofano.show',['reservarQuirofano'=>$reservaQuirofano])->with('message','doctor retirado del grupo');
    }
    public function agregarDoctor(request $request,reservaQuirofano $reservarQuirofano){
        $request->validate([
            'doctor'=>'required',
            'funcion'=>'required'
        ]);
        $fechaHoraInicio = Carbon::create($reservarQuirofano->fecha_hora);
        $fechaHoraFin = Carbon::create($fechaHoraInicio)->addHours($reservarQuirofano->cantidad_horas);
        
        $doctor = doctor::find($request->input('doctor'));
        if($doctor->tieneCirugiaProgramada($fechaHoraInicio, $fechaHoraFin))return redirect()->route('reservarQuirofano.show',['reservarQuirofano'=>$reservarQuirofano])->withErrors('doctor tiene el horario ocupado');
        $doctorQuirofano = new doctorQuirofano();
        $doctorQuirofano->doctor_id = $doctor->id;
        $doctorQuirofano->funcion = $request->input('funcion');
        $doctorQuirofano->reserva_quirofano_id = $reservarQuirofano->id;
        $doctorQuirofano->save();
        return redirect()->route('reservarQuirofano.show',['reservarQuirofano'=>$reservarQuirofano])->with('message','doctor agregado al grupo');
    }
}
