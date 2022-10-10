<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\Turno;
use App\Models\turnoDoctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class turnoDoctorController extends Controller
{
    public function asignar(doctor $doctor){
        $Turnos = Turno::all();
        $Dias = collect(['Lunes','Martes','Mercoles','Jueves','Viernes','Sabado','Domingo']);
        $DiasLibres = collect([]);
        foreach($Dias as $dia){
            $turnoOcupado = turnoDoctor::where('dia_atencion',$dia)->where('doctor_id',$doctor->id)->get();
            if($turnoOcupado->isEmpty()) $DiasLibres->push($dia);
        }
        if($DiasLibres->isEmpty()) return "el doctor no tiene dias libres para asigar turnos, libere uno o mas dias para asignar un nuevo turno";
        return view('TurnoDoctor.asignar',['doctor'=>$doctor, 'Turnos'=>$Turnos, 'Dias'=>$DiasLibres]);
    }
    public function store(Request $request, doctor $doctor){
        
        $dias = $request->input('dias');
        $turno = Turno::find($request->input('turno'));
        foreach ($dias as $dia) {
            $turnoDoctor = new turnoDoctor();
            $turnoDoctor->doctor_id = $doctor->id;
            $turnoDoctor->turno_id = $turno->id;
            $turnoDoctor->dia_atencion = $dia;
            $turnoDoctor->save();
        }
        return redirect()->route('turno.index');
        return $request;
    }
    public function show(doctor $doctor){
        $Doc_turnos = $doctor->turnoDoctor;
        return view('TurnoDoctor.show',['doctor'=>$doctor, 'Doc_turnos'=>$Doc_turnos]);
    }
    public function edit(Turno $turno, doctor $doctor){

    }
    public function destroy(turnoDoctor $turnoDoctor){
        $doctor = $turnoDoctor->doctor;
        $turnoDoctor->delete();
        return redirect()->route('turno-doctor.show',['doctor'=>$doctor]);
    }
}
