<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use App\Models\persona;
use App\Models\User;
use Illuminate\Http\Request;

class pacienteController extends Controller
{
    public function index()
    { 
        $pacientes = paciente::all();
        return view('gestionar_paciente.index',['pacientes'=>$pacientes]);
    }

    //crear
    public function create()
    {
        return view('gestionar_paciente.create');
    }

    public function store(Request $request)
    {
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
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'nombre_tutor'=>'required',
            'numero_telefono_tutor'=>'required',

        ]);
        $persona = new persona();
        $persona->ci = $request->ci;
        $persona->nombre = $request->nombre;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno;
        $persona->sexo = $request->sexo;
        $persona->edad = $request->edad;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->telefono = $request->telefono;
        $persona->direccion = $request->direccion;
        $persona->tipo = $request->tipo;
        $persona->save();
        
        $user = new User();
        $user->persona_id = $persona->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= bcrypt($request->password);

        $paciente = new paciente();
        $paciente->persona_id = $persona->id;
        $paciente->nombre_tutor = $request-> nombre_tutor;
        $paciente->numero_telefono_tutor = $request-> numero_telefono_tutor;
        $paciente->save();
        $user->save();
        return redirect()->route('paciente.index');
    }
    public function show($persona_id){
        $persona = persona::find($persona_id);
        $paciente = paciente::all();
        $user = User::all(); 
        $persona->load('paciente');
        $persona->load('user');
       return view('gestionar_paciente.show', compact('persona'));
    }

    public function edit($persona_id)
    { 
      $persona = persona::find($persona_id);
      $paciente = paciente::all();
      $user = User::all(); 
      $persona->load('paciente');
      $persona->load('user');
     return view('gestionar_paciente.edit', compact('persona'));
    }



    
    public function update(Request $request, $persona_id)
    {
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
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'nombre_tutor'=>'required',
            'numero_telefono_tutor'=>'required',
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
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno;
        $persona->sexo = $request->sexo;
        $persona->edad = $request->edad;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->telefono = $request->telefono;
        $persona->direccion = $request->direccion;
        $persona->tipo = $request->tipo;
        $persona->update();
        
        $user = User::where('persona_id',$persona_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= bcrypt($request->password);

        $paciente = paciente::where('persona_id',$persona_id)->first();
        $paciente->nombre_tutor = $request-> nombre_tutor;
        $paciente->numero_telefono_tutor = $request-> numero_telefono_tutor;
        $paciente->update();
        $user->update();
        return redirect()->route('paciente.index');
    }
    
    public function destroy($persona_id)
    {
        $persona = persona::findOrFail($persona_id);
        $paciente = paciente::where('persona_id',$persona_id)->first();
        $user = User::where('persona_id',$persona_id)->first();
        $user->delete($user);
        $paciente->delete($paciente);
        $persona->delete($persona);
        return redirect()->route('paciente.index');
    }
}
