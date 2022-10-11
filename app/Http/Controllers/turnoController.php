<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\Turno;
use App\Models\turnoDoctor;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class TurnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $Turnos = Turno::all();
        //$TurnoDoctors = turnoDoctor::all();
        $Doctores = doctor::all();
        return view('Turno.index',['Turnos'=>$Turnos, 'Doctores'=>$Doctores]);
    }
    public function create(){
        return view('Turno.create');
    }
    public function store(Request $request){
        $request->validate([
            'descripcion'=>'required',
            'hora_inicio'=>'required',
            'hora_fin'=>'required'
        ]);
        $turno = new Turno();
        $turno->descripcion = $request->input('descripcion');
        $turno->hora_inicio = $request->input('hora_inicio');
        $turno->hora_fin = $request->input('hora_fin');
        $turno->save();
        return redirect()->route('turno.index');
    }
    public function show(Turno $turno){
        return view('Turno.show',['turno'=>$turno]);
    }
    public function edit(Turno $turno){
        return view('Turno.edit', ['turno'=>$turno]);
    }
    public function update(Request $request, Turno $turno){
        $request->validate([
            'descripcion'=>'required',
            'hora_inicio'=>'required',
            'hora_fin'=>'required'
        ]);
        $turno->descripcion = $request->input('descripcion');
        $turno->hora_inicio = $request->input('hora_inicio');
        $turno->hora_fin = $request->input('hora_fin');
        $turno->update();
        return redirect()->route('turno.index');
    }
    public function destroy(Turno $turno){
        $turno->delete();
        return redirect()->route('turno.index');
    }
}
