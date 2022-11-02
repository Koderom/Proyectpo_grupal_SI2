<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\doctor;
use App\Models\User;
use App\Models\especialidad;
use App\Models\persona;
use Illuminate\Support\Facades\DB;

class doctorController extends Controller
{
    public function index(){
        $doctores=doctor::all();
        return view('gestionar_doctor.index', compact('doctores'));
        
    }
    public function create(){ //crear
        // $especialidad=especialidad::get();
        // // $vista=doctor::get();
        //  return view('gestionar_doctor.create', compact('especialidad')) ;
        // // ['doctor'=>$vista]);
         $Especialidades=especialidad::get();
         return view('gestionar_doctor.create',['Especialidades' => $Especialidades]);
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
        $user = new User();
        $user->persona_id = $p->id;
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password= bcrypt($r->password);
        $user->save();

         $d= new doctor();
         $d->formacion='$r->formacion';
         $d->especialidad_id = request()->input('especialidad_id');
         $d->persona_id=$p->id;
        
         $d->save();
    
         return redirect()->route('doctores.index');
         }

         public function show($persona_id){
        //     $persona = persona::find($persona_id);
        //     $doctor = doctor::all();
        //     $persona->load('doctor');
        //     $persona->load('user');
        //    return view('gestionar_doctor.show', compact('persona'));
        $doctor = doctor::find($persona_id);
        $Especialidades=especialidad::all();
        return view('gestionar_doctor.show',['Especialidades' => $Especialidades,'doctor'=>$doctor]);    
        }

        public function edit($persona_id)
    { 
      $doctor = doctor::findOrFail($persona_id);
    //   $persona = $doctor->persona;
    //   $user = $persona->user;
      $Especialidades=especialidad::all();
    //   @dd($persona);
    //   return $persona;
    //   $persona->load('doctor');
    //   $persona->load('user');
    //   $persona->load('Especialidades');
    //   $doctor = doctor::all();
    //   $user = User::all(); 
    //   $persona->load('doctor');
    //   $persona->load('6');
    // return compact('persona');
    //  return view('gestionar_doctor.edit', compact('persona'));
     return view('gestionar_doctor.edit',['Especialidades' => $Especialidades,'doctor'=>$doctor]);
    }

    
      public function update(Request $request, $persona_id){
        // return $request;
       // $r->validate([

        $request->validate([

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
       $persona_ci = persona::where('ci', $request->ci)->where('id', '!=', $persona_id)->first();
        if (!is_null($persona_ci)) {
        return back()->withErrors(['Ci ya esta registrado, intente con otro']);
        }
        $persona_usuario = User::where('name', $request->name)->where('persona_id', '!=', $persona_id)->first();
        if (!is_null($persona_usuario)) {
        return back()->withErrors(['El usuario ya existe, intente con otro']);
        }
        $persona_email = User::where('email', $request->email)->where('persona_id', '!=', $persona_id)->first();
        if (!is_null($persona_email)) {
        return back()->withErrors(['Email ya esta registrado, intente con otro']);
        }
       $persona = persona::find($persona_id);
       $persona->ci = $request->ci;
       $persona->nombre = $request->nombre;
       $persona->tipo = $request->tipo;
       $persona->apellido_paterno = $request->apellido_paterno;
       $persona->apellido_materno = $request->apellido_materno;
       $persona->sexo = $request->sexo;
       $persona->edad = $request->edad;
       $persona->fecha_nacimiento = $request->fecha_nacimiento;
       $persona->telefono = $request->telefono;
       $persona->direccion = $request->direccion;
       $persona->update();


        // $p->ci = $r->ci;
        // $p->nombre=$r->nombre;
        // $p->tipo=$r->tipo;
        // $p->apellido_paterno=$r->apellido_paterno;
        // $p->apellido_materno=$r->apellido_materno;
        // $p->sexo=$r->sexo;
        // $p->edad=$r->edad;
        // $p->fecha_nacimiento=$r->fecha_nacimiento;
        // $p->telefono=$r->telefono;
        // $p->direccion=$r->direccion;

        // $p->save();
        $user = User::where('persona_id',$persona_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= bcrypt($request->password);
        $user->update();

        $doctor = doctor::where('persona_id',$persona_id)->first();
        // $d= new doctor();
        $doctor->formacion='$doctor->formacion';
        $doctor->especialidad_id = request()->input('especialidad_id');
        $doctor->persona_id=$persona->id;
        $doctor->update();
        
        
        return redirect()->route('doctores.index');
    }
    public function destroy(doctor $id_doctor) //eliminar
    {
      try{
        DB::beginTransaction();
        $id_doctor->delete();
        DB::commit();
      }catch(\Exception $e){
        DB::rollBack();
      }
      return redirect()->route('doctores.index');
       
    }
}
