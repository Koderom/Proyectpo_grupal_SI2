<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\agenda;
use App\Models\cita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'email|required',
            'password'=>'required'
        ]);
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token',$token, 60*24);
            return response(["token"=>$token],Response::HTTP_OK)->withoutCookie($cookie);
        }else{
            return response(["message"=>"contraseña o correo invalidas"],Response::HTTP_UNAUTHORIZED);
        }
        
    }
    public function userProfile(Request $request){
        return response()->json([
            "messaje"=>"userProfile OK",
            "userData"=> auth()->user()
        ],Response::HTTP_OK);
    }
    public function logout(Request $request){
        $cookie = Cookie::forget('cookie_token');
        return response([
            "message"=>"cierre de sesion OK"
        ], Response::HTTP_OK)->withCookie($cookie);
    }
    public function verMiAgenda(){
        $usuario = Auth::user();
        if($usuario->persona->tipo[0]=='D'){
            $doctor = $usuario->persona->doctor;
            $myTime = Carbon::now('America/La_Paz');            
            $miAgenda = agenda::where('fecha', $myTime->toDateString())
            ->where('doctor_id',$doctor->id)
            ->first();
            if($miAgenda == null){
                return response()->json([
                    "message" => "El doctor no tiene citas para este dia",
                    "error" => 2
                ],);    
            }
            $cupos = $miAgenda->cupo->where('estado','C');
            foreach($cupos as $cupo) $cupo->cita;
            return response()->json([
                "fecha" => $miAgenda->fecha,
                "citas" => $cupos,
                "error" => 0
            ]);
        }else{
            return response()->json([
                "message" => "El usuario no es un medico",
                "error" => 1
            ],);
        }
        
    }
}
