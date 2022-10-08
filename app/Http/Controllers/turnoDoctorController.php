<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\Turno;
use Illuminate\Http\Request;

class turnoDoctorController extends Controller
{
    public function create(){
        $Doctores = doctor::all();
        $Turnos = Turno::all();
        return view('TurnoDoctor.create',['Doctores'=>$Doctores, 'Turnos'=>$Turnos]);
    }
}
