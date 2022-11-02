<?php

namespace App\Http\Controllers;

use App\Models\quirofano;
use App\Models\reservaQuirofano;
use App\Models\sala;
use App\Models\sector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class quirofanoController extends Controller
{
    public function index(){
        $Salas = sala::where('tipo_sala','Q')->get();
        return view('Quirofano.index',['Salas'=>$Salas]);
    }
    public function show(sala $sala){
        $myTime = Carbon::now('America/La_Paz');
        $reservaQuirofanos = reservaQuirofano::where('reserva_quirofanos.quirofano_id',$sala->quirofano->id)
                            ->where('reserva_quirofanos.fecha_hora_entrada','>',$myTime->toDateTimeString())
                            ->get();
        return view('Quirofano.show',['sala'=>$sala, 'reservaQuirofanos'=>$reservaQuirofanos]);
    }
    public function create(){
        if(sector::count() == 0) return back()->withErrors('Antes de registrar una sala, de debe registrar un sector');
        $Sectores = sector::all();
        return view('Quirofano.create',['Sectores'=>$Sectores]);
    }
    public function store(Request $request){
        $request->validate([
            'numero_de_sala'=>'required|unique:salas,nro_sala',
            'capacidad'=>'required'
        ]);
        $salaQuirofano = new sala();
        $salaQuirofano->nro_sala = $request->input('numero_de_sala');
        $salaQuirofano->capacidad = $request->input('capacidad');
        $salaQuirofano->tipo_sala = 'Q';
        $salaQuirofano->sector_id = $request->input('sector');
        $salaQuirofano->save();

        $quirofano = new quirofano();
        $quirofano->estado = 'V';
        $quirofano->sala_id = $salaQuirofano->id;
        $quirofano->save();

        return redirect()->route('quirofano.index')->with('message','Quirofano registrado');
    }
}
