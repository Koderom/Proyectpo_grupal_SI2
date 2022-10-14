<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\doctor;
use App\Models\especialidad;
use App\Models\persona;


class doctorController extends Controller
{
    public function index(){
        $doctores=doctor::get();
        return view('gestionar_doctor.index', compact('doctores'));
    }
    public function create(){ //crear
        $especialidad=especialidad::get();
        // $vista=doctor::get();
         return view('gestionar_doctor.create', compact('especialidad')) ;
        // ['doctor'=>$vista]);
    }
     public function store(Request $r){ //guardar
         //dd($r);
         $r->validate([
            'ci'=>'required',
            'nombre'=>'required',
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            'sexo'=>'required',
            'edad'=>'required',
            'fecha_nacimiento'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            'nombre'=>'required',
            'email'=>'required',
            'password'=>'required',
            'especialidad_id'=>'required',
        ]);
        
         $p = new persona();
         $p->ci=$r->ci;
         $p->nombre=$r->nombre;
         $p->tipo=$r->tipo;
         $p->apellido_paterno=$r->apellido_paterno;
         $p->apellido_materno=$r->apellido_materno;
         $p->sexo=$r->sexo;
         $p->edad=$r->edad;
         $p->fecha_nacimiento=$r->fecha_nacimiento;
         $p->telefono=$r->telefono;
         $p->direccion=$r->direccion;

         $p->save();

            // $e= new especialidad();
            // $e->nombre=$r->especialidad;

            // $e->save();
        


         $d= new doctor();
         $d->formacion='$r->formacion';
         $d->especialidad_id = request()->input('especialidad_id');
         $d->persona_id=$p->id;

         $d->save();
    
         return redirect()->route('doctores.index');
         }
         public function show($persona_id){
            $persona = persona::find($persona_id);
            $doctor = doctor::all();
            $persona->load('doctor');
           return view('gestionar_doctor.show', compact('doctor'));
        }
    
        public function edit($persona_id)
        { 
          $persona = persona::find($persona_id);
          $doctor = doctor::all(); 
          $persona->load('administrativo');
         return view('gestionar_doctor.edit', compact('doctor'));
        }

    public function destroy(doctor $id_doctor) //eliminar
    {
        $id_doctor->delete();
         return redirect()->route('doctores.index');
       
    }
   
}
