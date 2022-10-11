<?php

namespace App\Http\Controllers;

use App\Models\administrativo;
use App\Models\doctor;
use App\Models\paciente;
use App\Models\persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Break_;

class UserController extends Controller
{
    public function loginView()
    {
        return view('login');
    }
    public function login(){
        $credenciales = request()->validate([
            'email' => 'required|email|string',
            'password'=> 'required|string'
        ]);
        if(Auth::attempt($credenciales, true)){
            request()->session()->regenerate();
            return redirect()->route('home');
        }
        return redirect()->route('login');
    }
    
    public function menu()
    {
        return view('menu');
    }
    public function logout(Request $request ){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function index()
    {
        $usuarios= User::all();
        return view('gestionar_usuario.index')->with('usuarios', $usuarios);
    }

    public function show($persona_id){
        $persona = persona::find($persona_id);
        $administrativo = administrativo::all();
        $paciente = paciente::all();
        $doctor = doctor::all();
        $user = User::all(); 
        $persona->load('administrativo');
        $persona->load('paciente');
        $persona->load('doctor');
        $persona->load('user');
       return view('gestionar_usuario.show', compact('persona'));
    }
    public function edit($persona_id)
    {
        $persona = persona::find($persona_id);
        $administrativo = administrativo::all();
        $paciente = paciente::all();
        $doctor = doctor::all();
        $user = User::all(); 
        $persona->load('administrativo');
        $persona->load('paciente');
        $persona->load('doctor');
        $persona->load('user');
       return view('gestionar_usuario.edit', compact('persona'));
    }
    public function update(Request $request, $persona_id){
        $request->validate([
            'name'=>'required',
            'password'=>'required',
        ]);
        $persona_usuario = User::where('name', $request->name)->where('persona_id', '!=', $persona_id)->first();
        if (!is_null($persona_usuario)) {
        return back()->withErrors(['El usuario ya existe, intente con otro']);
        }
        //$persona = persona::find($persona_id);
        $user = User::where('persona_id',$persona_id)->first();
        $user->name = $request->name;
        //$user->email = $request->email;
        $user->password= bcrypt($request->password);
        $user->update();
        return redirect()->route('usuario.index');
    }

    public function destroy($persona_id)
    {
        $persona = persona::findOrFail($persona_id);
        
        //$user = User::where('persona_id',$persona_id)->first();
        $usuario= $persona->user;
        $usuario->delete();
        
        switch ($persona->tipo[0]) {
             case 'A':
                 $administrativo = administrativo::where('persona_id',$persona_id)->first();
                 $administrativo->delete($administrativo);
                 break;
             case 'P':                
                 $paciente = paciente::where('persona_id',$persona_id)->first();
                 $paciente->delete($paciente);
                 break;
             case 'D':
                 $doctor = doctor::where('persona_id',$persona_id)->first();
                 $doctor->delete($doctor);
                 break;
             
             default:
                 # code...
                 break;
         }
        $persona->delete(); 

        return redirect()->route('usuario.index');
    }

}
