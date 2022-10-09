<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use App\Models\doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Comment\Doc;
use Symfony\Contracts\Service\Attribute\Required;

class agendaController extends Controller
{
    public function index(){
        $Doctores = doctor::all();
        return view('Agenda.index',['Doctores'=>$Doctores]);
    }
    public function show(doctor $doctor){
        $Agendas = $doctor->agenda;
        return $Agendas;
    }
}
