<?php

namespace App\Http\Controllers;

use App\Models\tipoInternacion;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class tipoInternacionController extends Controller
{
    public function store(Request $request){
        if($request->input('tipo_internacion') !== null){
            $tipoInternacion = new tipoInternacion();
            $tipoInternacion->descripcion = $request->input('tipo_internacion');
            $tipoInternacion->save();
            return redirect()->route('internacion.index')->with('message','Guardado exitosamente');
        }else{
            return redirect()->route('internacion.index')->withErrors('No se ha escrito ningun dato para tipo de internacion');
        }
    }
}
