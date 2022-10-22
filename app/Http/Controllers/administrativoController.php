<?php

namespace App\Http\Controllers;

use App\Models\administrativo;
use App\Models\persona;
use App\Models\User;
use Illuminate\Http\Request;

class administrativoController extends Controller
{
    public function index()
    { 
        /*$persona = persona::where('tipo','A')->get();
        $administrativo = administrativo::all();
        $user = User::all();
        $persona->load('administrativo');
        $persona->load('user');
        return view('gestionar_administrativo.index', compact('persona'));
        */
        $administrativos = administrativo::all();
        return view('gestionar_administrativo.index',['administrativos'=>$administrativos]);
    }

    //crear
    public function create()
    {
        return view('gestionar_administrativo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ci'=>'required|unique:personas',
            'nombre'=>'required',
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            'sexo'=>'required',
            'edad'=>'required',
            'fecha_nacimiento'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            'name'=>'required|unique:users',
            'email'=>'required|unique:users',
            'password'=>'required',
            'cargo'=>'required',

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

        $administrativo = new administrativo();
        $administrativo->persona_id = $persona->id;
        $administrativo->cargo = $request-> cargo;
        $administrativo->save();
        $user->save();
        return redirect()->route('administrativo.index');
    }
    public function show($persona_id){
        $persona = persona::find($persona_id);
        $administrativo = administrativo::all();
        $user = User::all(); 
        $persona->load('administrativo');
        $persona->load('user');
       return view('gestionar_administrativo.show', compact('persona'));
    }

    public function edit($persona_id)
    { 
      $persona = persona::find($persona_id);
      $administrativo = administrativo::all();
      $user = User::all(); 
      $persona->load('administrativo');
      $persona->load('user');
     return view('gestionar_administrativo.edit', compact('persona'));
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
            'cargo'=>'required',

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

        $administrativo = administrativo::where('persona_id',$persona_id)->first();
        $administrativo->cargo = $request-> cargo;
        $administrativo->update();
        $user->update();
        return redirect()->route('administrativo.index');
    }
    
    public function destroy($persona_id)
    {
        $persona = persona::findOrFail($persona_id);
        $administrativo = administrativo::where('persona_id',$persona_id)->first();
        $user = User::where('persona_id',$persona_id)->first();
        $user->delete($user);
        $administrativo->delete($administrativo);
        $persona->delete($persona);
        return redirect()->route('administrativo.index');
    }
 
}
