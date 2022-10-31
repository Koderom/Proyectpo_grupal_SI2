<?php

namespace App\Http\Controllers;

use App\Models\cama;
use App\Models\consultorio;
use App\Models\internacion;
use App\Models\quirofano;
use App\Models\sala;
use App\Models\sector;
use App\Models\tipoInternacion;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class salaController extends Controller
{
    public function index(){
        $Salas = sala::all();
        return view('Sala.index',['Salas'=>$Salas]);
    }
    public function create(){
        $Sectores = sector::all();
        $TipoInternacions = tipoInternacion::all();
        return view('Sala.create',['Sectores'=>$Sectores, 'TipoInternacions'=>$TipoInternacions]);
    }
    public function store(Request $request){
        $request->validate([
            'numero_de_sala'=>'required',
            'capacidad'=>'required',
            'tipo_sala'=>'required',
            'sector'=>'required',
        ]);
        if($request->input('tipo_sala') == 'Internacion') $request->validate([
            'tipo_internacion' => 'required',
            'cantidad_camas' => 'required'
        ]);
        $sala = new sala();
        $sala->nro_sala = $request->input('numero_de_sala');
        $sala->capacidad = $request->input('capacidad');
        $sala->tipo_sala = $request->input('tipo_sala');
        $sala->sector_id = $request->input('sector');
        $sala->save();

        switch($sala->tipo_sala[0]){
            case 'I':
                $internacion = new internacion();
                $internacion->tipo_internacion_id = $request->input('tipo_internacion');
                $internacion->sala_id = $sala->id;
                $internacion->save();
                $cantidad_camas = $request->input('cantidad_camas');
                for ($i=0; $i < $cantidad_camas; $i++) { 
                    $cama = new cama();
                    $cama->nro_cama = $i;
                    $cama->estaOcupado = false;
                    $cama->internacion_id = $internacion->id;
                    $cama->save();
                }
                break;
            case 'C':
                $consultorio = new consultorio();
                $consultorio->estado = 'D';
                $consultorio->sala_id = $sala->id;
                $consultorio->save();
                break;
            case 'Q':
                $quirofano = new quirofano();
                $quirofano->estado = 'D';
                $quirofano->sala_id = $sala->id;
                $quirofano->save();
                break;
        }
        return redirect()->route('sala.index');
    }
    public function verMas(sala $sala){
        switch ($sala->tipo_sala[0]) {
            case 'I':
                return redirect()->route('internacion.show',['sala'=>$sala]);
                break;
            
            default:
                return "Error inesperado";
                break;
        }
    }
}
