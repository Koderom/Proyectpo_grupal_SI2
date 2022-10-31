<?php

namespace App\Http\Controllers;

use App\Models\cama;
use App\Models\camaPaciente;
use App\Models\internacion;
use App\Models\paciente;
use App\Models\sala;
use App\Models\sector;
use App\Models\tipoInternacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Monolog\Handler\RedisHandler;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

use function PHPUnit\Framework\returnSelf;

class internacionController extends Controller
{
    public function index(){
        $SalasInternacion = sala::where('tipo_sala','I')->groupBy('id','sector_id')->get();
        return view('Internacion.index',['SalasInternacion'=>$SalasInternacion]);
    }
    public function show(sala $sala){
        //añadir consulta para ver pacientes registrados
        $Pacientes = paciente::join('cama_pacientes','cama_pacientes.paciente_id','=','pacientes.id')
                    ->join('camas','camas.id','=','cama_pacientes.cama_id')
                    ->join('internacions','internacions.id','=','camas.internacion_id')
                    ->join('salas', 'salas.id','=','internacions.sala_id')
                    ->where('salas.id','=', $sala->id)
                    ->whereNull('cama_pacientes.fecha_de_salida')
                    ->select('pacientes.*', 'cama_pacientes.fecha_ingreso')
                    ->get();
        return view('Internacion.show',['sala'=>$sala, 'Pacientes'=>$Pacientes]);
    }
    public function internarPaciente(){
        $Sectores = sector::join('salas','salas.sector_id','=','sectors.id')
                    ->where('salas.tipo_sala','=','I')
                    ->select('sectors.*')
                    ->distinct()
                    ->get();
        $Salas = sala::where('tipo_sala','=','I')->get();
        foreach($Salas as $sala) $sala->internacion->tipoInternacion;
        $Pacientes = paciente::all();
        return view('Internacion.internarPaciente',['Sectores'=>$Sectores, 'Salas'=>$Salas, 'Pacientes'=>$Pacientes]);
    }
    public function internarPacienteStore(Request $request){
        $MyTime = Carbon::now('America/La_Paz');
        $sala = sala::find($request->input('sala'));//sala_id
        $camaLibre = $this->buscarCamaLibre($sala);
        if($camaLibre == null)//redirect()->route('internacion.index')->withErrors('No hay camas disponibles en la sala');
        $camaLibre = cama::find($camaLibre->id);
        $camaLibre->estaOcupado = true;
        $camaLibre->update();
        $camaPaciente = new camaPaciente();
        $camaPaciente->fecha_ingreso = $MyTime->toDateString();
        $camaPaciente->cama_id = $camaLibre->id;
        $camaPaciente->paciente_id = $request->input('paciente');//paciente_id
        $camaPaciente->save();
        return Redirect()->route('internacion.index')->with('message','paciente registrado en la sala de intercacion');
    }
    public function retirarPaciente(paciente $paciente){
        $MyTime = Carbon::now('America/La_Paz');
        $camaPaciente = $paciente->camaPaciente->whereNull('fecha_de_salida')->first();
        $cama = $camaPaciente->cama;
        $camaPaciente->fecha_de_salida = $MyTime->toDateString();
        $camaPaciente->save();
        $cama->estaOcupado = false;
        $cama->save();
        return back()->with('message','paciente retirado de internacion');
    }
    public function create(){
        $Sectores = sector::all();
        $TiposInternacion = tipoInternacion::all();
        return view('Internacion.create',['Sectores'=>$Sectores , 'TiposInternacion'=>$TiposInternacion]);
    }
    public function store(Request $request){
        $request->validate([
            'numero_de_sala'=>'required',
            'capacidad'=>'required',
            'sector'=>'required',
            'cantidad_camas'=>'required',
            'tipo_internacion'=>'required'
        ]);
        $sala = new sala();
        $sala->nro_sala = $request->input('numero_de_sala');
        $sala->capacidad = $request->input('capacidad');
        $sala->tipo_sala = 'I';
        $sala->sector_id = $request->input('sector');
        $sala->save();

        $internacion = new internacion();
        $internacion->tipo_internacion_id = $request->input('tipo_internacion');
        $internacion->sala_id = $sala->id;
        $internacion->save();
        $cantidad_camas = $request->input('cantidad_camas');
                for ($i=1; $i <= $cantidad_camas; $i++) { 
                    $cama = new cama();
                    $cama->nro_cama = $i;
                    $cama->estaOcupado = false;
                    $cama->internacion_id = $internacion->id;
                    $cama->save();
        }
        return redirect()->route('internacion.index');
    }
    public function destroy(sala $sala){
        $cantidadCamasAsignadas = $sala->internacion->cama->where('estaOcupado',true)->count();
        if($cantidadCamasAsignadas > 0) return back()->withErrors('no se puede eliminar, la sala esta ocupada por pacientes');
        $Camas= $sala->internacion->cama;
        foreach($Camas as $cama){
            $Registros = $cama->camaPaciente;
            if($Registros == null){
                $cama->delete();
                continue;
            } 
            foreach($Registros as $registro){
                $registro->delete();
            }
            $cama->delete();
        }
        $sala->internacion->delete();
        $sala->delete();
        return redirect()->route('internacion.index')->with('message','Sala internacion eliminada');
    }
    /*Funciones auxiliares */
    private function buscarCamaLibre(sala $sala){
        if($sala->tipo_sala[0] != 'I') return null;
        $camas = $sala->internacion->cama;
        foreach($camas as $cama){
            if($cama->estaOcupado == false) return $cama;
        }
        return null;
    }
}
