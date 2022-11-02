<?php

namespace App\Http\Controllers;

use App\Models\asignacionCosultorio;
use App\Models\doctor;
use App\Models\sala;
use Carbon\Carbon;
use Illuminate\Http\Request;

class asignacionConsultorioController extends Controller
{
    public function create(){
        $Doctores = doctor::whereNotIn('doctors.id',function($query){
            $query->from('asignacion_consultorios')
            ->select('asignacion_consultorios.doctor_id');
        })
        ->get();
        $SalasConsultorios = sala::where('tipo_sala','C')->get();
        if($SalasConsultorios->count() == 0) return redirect()->back()->withErrors('Primero se debe registrar un consultorio');
        return view('Consultorio.asignar',['Doctores'=>$Doctores, 'SalasConsultorios'=>$SalasConsultorios]);
    }
    public function store(Request $request){
        $request->validate([
            'doctor'=>'required',
            'sala'=>'required',
            'fecha_inicio'=>'required',
            'cantidad_dias'=>'required',
            'hora_entrada'=>'required',
            'hora_salida'=>'required'
        ]);
        $fechaInicio = $request->input('fecha_inicio');
        $cantDias = $request->input('cantidad_dias');
        $horaInicio = $request->input('hora_entrada');
        $horaFin = $request->input('hora_salida');
        $fechaFin = Carbon::createFromFormat('Y-m-d H:i:s.u', $fechaInicio.' '.$horaFin.':00.000000');
        $fechaFin = $fechaFin->addDays($cantDias);
        
        $sala = sala::find($request->input('sala'));
        if($sala->consultorio->tieneHoraAsignada($horaInicio,$horaFin))return redirect()->back()->withErrors('El horario esta ocupado');

        $asignacionConsultorio = new asignacionCosultorio();
        $asignacionConsultorio->fecha_inicio = $fechaInicio;
        $asignacionConsultorio->cantidad_dias = $cantDias;
        $asignacionConsultorio->fecha_finalizacion = $fechaFin->toDateString();
        $asignacionConsultorio->hora_entrada = $horaInicio;
        $asignacionConsultorio->hora_salida = $horaFin;
        
        $asignacionConsultorio->consultorio_id = $sala->consultorio->id;
        $asignacionConsultorio->doctor_id = $request->input('doctor');
        $asignacionConsultorio->save();
        return redirect()->route('consultorio.index')->with('message','se ha asignado la sala');
    }

    public function destroy(asignacionCosultorio $asignacionConsultorio){
        $sala = $asignacionConsultorio->consultorio->sala;
        $asignacionConsultorio->delete();
        return redirect()->route('consultorio.show',['sala'=>$sala])->with('message','se ha eliminado la asignacion');
    }
}
