<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reporteController extends Controller
{
    private $Tablas = ['users','personas','doctors','administrativos','pacientes'];

    public function index(){
        return view('Reporte.index',[
            'Tablas' => collect($this->Tablas)
        ]);
    }
    public function create(Request $request){
        $tabla = DB::table($request->tabla)->get();
        return $tabla;
    }
}
