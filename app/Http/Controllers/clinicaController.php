<?php

namespace App\Http\Controllers;

use App\Models\clinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class clinicaController extends Controller
{
    public function index(){
        if (clinica::count()==0) {
            return view('Clinica.index',['clinica'=>null]);
        }
        $clinica = clinica::first();
        if($clinica == null) return view('Clinica.create');
        return view('Clinica.index',['clinica'=>$clinica]);
    }
    public function create(){
        return view('Clinica.create');
    }
    public function store(Request $request){
        $request->validate([
            'logo'=>'required|image',
            'nombre'=>'required'
        ]);
        $logoImagen = $request->file('logo')->store('public/imagenes/logo');
        //$url = Storage::url($logoImagen);
        
        if(clinica::all()->count() == 0){
            $clinica = new clinica();
            $clinica->nombre = $request->input('nombre');
            $clinica->logo_url = $logoImagen;
            $clinica->save();
        }else{
            $clinica = clinica::first();
            if(Storage::exists($clinica->logo_url)){
                Storage::delete($clinica->logo_url);
            }
            $clinica->nombre = $request->input('nombre');
            $clinica->logo_url = $logoImagen;
            $clinica->update();
        }
        return redirect()->route('clinica.index')->with('message','cambios guardados');
    }
}
