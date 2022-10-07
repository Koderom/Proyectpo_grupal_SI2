<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginView()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'name'=> ['required', 'max:50'],
            'password'=> ['required'],
        ]);
        $usuario = User::where('name',$request-> name)->first();
        if (is_null($usuario)) {
            return back()->withErrors(['error' => 'el usuario no existe']);
        }
        if (Auth::guard('admin')->attempt(['name'=>$request->name,'password'=>$request->password])) {
            return redirect()->route('menu');
        }
        return back()->withErrors(['Error' => 'la contraseña es incorrecta']);
    }
    
    public function menu()
    {
        return view('menu');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login.view');
    }

    public function index()
    {
        $usuarios= User::all();
        return view('gestionar_usuario.index')->with('usuarios', $usuarios);
    }

    public function edit($user_id)
    {
      $usuarios = User::findOrFail($user_id);
      $usuarios->load('usuario');
      return view('gestionar_usuario.edit', ['usuarios' => $user_id]);
    }

}
