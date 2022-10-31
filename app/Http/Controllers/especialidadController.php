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
        $especialidades = especialidad::all();
        // dd($especialidades);
        // return view('VistaEspecialidades.index',['especialidades'=>$especialidades]);
        return view('VistaEspecialidades.index', compact('especialidades'));
    }
    public function create()
    {
        return view('VistaEspecialidades.create');
    }
    public function store(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'id'=>'required',
        //     'nombre'=>'required',
        // ]);
        // $especialidad -> id =$request->input('id');
        $especialidad = new especialidad();
        $especialidad->nombre = $request->especialidad;
        $especialidad->save();
        return redirect()->route('especialidad.index');
    }
    public function show(especialidad $especialidad)
    {
        return view('VistaEspecialidades.show', ['especialidad' => $especialidad]);
    }

    public function edit(especialidad $id)
    {
        // dd($id);
        $editar = especialidad::where('id',$id->id)->first();
        // dd($editar->id);
        return view('VistaEspecialidades.edit', compact('editar'));
    }

    public function update(Request $request, especialidad $especialidad)
    {
        // dd($request);
        // $request->validate([
        //     'id' => 'required',
        //     'nombre' => 'required',
        // ]);
        $especialidad->id = $request->id;
        $especialidad->nombre = $request->especialidad;
        $especialidad->update();
        return redirect()->route('especialidad.index');
    }
    public function destroy(especialidad $id)
    {
        $id->delete();
        return redirect()->route('especialidad.index');
    }
}
