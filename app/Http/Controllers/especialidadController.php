<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\especialidad;
use App\Models\turno;
use App\Models\doctor;

class especialidadController extends Controller
{
    public function index()
    { 
        // // return view('VistaEspecialidades.index');
        // $especialidades = especialidad::all();
        // //$TurnoDoctors = turnoDoctor::all();
        // $Doctores = especialidad::all();
        // return view('VistaEspecialidad.index',['especialidades'=>$especialidades, 'Especialidades'=>$especialidades]);
        $Especialidades = especialidad::all();
        //$TurnoDoctors = turnoDoctor::all();
        $Doctores = doctor::all();
        return view('especialidad.index',['Especialidades'=>$Especialidades, 'Doctores'=>$Doctores]);
    }
    public function create()
    {
        return view('especialidad.create');
    }
    public function store(Request $request)
    {

    }
}
