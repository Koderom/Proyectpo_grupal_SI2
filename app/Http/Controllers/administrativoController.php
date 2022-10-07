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
        $persona = persona::where('tipo','A')->get();
        $administrativo = administrativo::all();
        $user = User::all();
        $persona->load('administrativo');
        $persona->load('user');
        return view('gestionar_administrativo.index', compact('persona'));
    }

    //crear
    public function create()
    {
        return view('gestionar_administrativo.create');
    }

    public function store(Request $request)
    {
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


}
