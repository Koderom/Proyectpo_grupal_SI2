<?php

namespace App\Http\Controllers;

use App\Models\bitacora;
use App\Models\persona;
use Illuminate\Http\Request;

class bitacoraController extends Controller
{
    public function index(){
        $Bitacoras = bitacora::paginate(10);
        return view('Bitacora.index',['Bitacoras'=>$Bitacoras]);
    }
    public function show(Bitacora $bitacora){
        $persona = persona::find($bitacora->persona_id);
        return view('Bitacora.show',['bitacora' => $bitacora, 'persona' => $persona]);
    }
}
