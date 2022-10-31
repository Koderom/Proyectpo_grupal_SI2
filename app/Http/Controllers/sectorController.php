<?php

namespace App\Http\Controllers;

use App\Models\sector;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class sectorController extends Controller
{
    public function index(){
        $Sectores = sector::all();
        return view('Sector.index',['Sectores'=>$Sectores]);
    }
    public function create(){
        return view('Sector.create');
    }
    public function store(Request $request){
        $request->validate([
            'nombre_de_sector' => 'required',
            'piso_de_ubicacion' => 'required',
            'funcionalidad_del_sector' => 'required'
        ]);
        $sector = new sector();
        $sector->nombre = $request->input('nombre_de_sector');
        $sector->piso = $request->input('piso_de_ubicacion');
        $sector->funcionalidad = $request->input('funcionalidad_del_sector');
        $sector->save();
        return redirect()->route('sector.index');
    }
    public function edit(sector $sector){
        return view('Sector.edit',['sector'=>$sector]);
    }
    public function update(sector $sector, Request $request){
        $request->validate([
            'nombre_de_sector' => 'required',
            'piso_de_ubicacion' => 'required',
            'funcionalidad_del_sector' => 'required'
        ]);
        $sector->nombre = $request->input('nombre_de_sector');
        $sector->piso = $request->input('piso_de_ubicacion');
        $sector->funcionalidad = $request->input('funcionalidad_del_sector');
        $sector->update();
        return redirect()->route('sector.index');
    }
}
