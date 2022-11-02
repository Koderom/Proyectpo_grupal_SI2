<?php

namespace App\Http\Controllers;

use App\Models\asignacionCosultorio;
use App\Models\consultorio;
use App\Models\sala;
use App\Models\sector;
use Illuminate\Http\Request;

class consultorioController extends Controller
{
    public function index(){
        $Salas = sala::where('tipo_sala','C')->get();
        return view('Consultorio.index',['Salas'=>$Salas]);
    }
    public function create(){
        $Sectores = sector::all();
        if($Sectores->count() == 0) return redirect()->back()->withErrors('Se debe registrar almenos un sector antes de crear una sala');
        return view('Consultorio.create',['Sectores'=>$Sectores]);
    }
    public function store(Request $request){
        $request->validate([
            'numero_de_sala'=>'required|unique:salas,nro_sala',
            'capacidad'=>'required',
            'sector'=>'required'
        ]);
        $salaConsultorio = new sala();
        $salaConsultorio->nro_sala = $request->input('numero_de_sala');
        $salaConsultorio->capacidad = $request->input('capacidad');
        $salaConsultorio->tipo_sala = 'C';
        $salaConsultorio->sector_id = $request->input('sector');
        $salaConsultorio->save();

        $consultorion = new consultorio();
        $consultorion->estado = 'D';
        $consultorion->sala_id = $salaConsultorio->id;
        $consultorion->save();
        return redirect()->route('consultorio.index')->with('message','se ha registrado la sala');
    }
    public function show(sala $sala){
        $Aginaciones = asignacionCosultorio::where('consultorio_id',$sala->consultorio->id)
        ->orderBy('fecha_inicio','desc')
        ->get();
        return view('Consultorio.show',['sala'=>$sala, 'Asignaciones'=>$Aginaciones]);
    }
    public function edit(sala $sala){
        $Sectores = sector::all();
        if($Sectores->count() == 0) return redirect()->back()->withErrors('Se debe registrar almenos un sector antes de crear una sala');
        return view('Consultorio.edit',['Sectores'=>$Sectores, 'sala'=>$sala]);
    }
    public function update(Request $request, sala $sala){
        $request->validate([
            'numero_de_sala'=>'required|unique:salas,nro_sala',
            'capacidad'=>'required',
            'sector'=>'required'
        ]);
        $sala->nro_sala = $request->input('numero_de_sala');
        $sala->capacidad = $request->input('capacidad');
        $sala->sector_id = $request->input('sector');
        $sala->update();
        return redirect()->route('consultorio.index')->with('message','se ha modificado los datos de la sala');
    }
    public function destroy(sala $sala){
        $asignaciones = $sala->consultorio->asignacionConsultorio;
        if($asignaciones->count() > 0) return redirect()->route('consultorio.index')->withErrors('La sala tiene doctores asignados');
        $sala->consultorio->delete();
        $sala->delete();
        return redirect()->route('consultorio.index')->with('message','se ha eliminado la sala');
    }
}
