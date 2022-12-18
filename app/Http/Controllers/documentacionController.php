<?php

namespace App\Http\Controllers;

use App\Models\documentacion;
use App\Models\documento_etiqueta;
use App\Models\etiqueta;
use App\Models\historial_clinico;
use App\Models\paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class documentacionController extends Controller
{
    public function index(Request $request){
        $Documentos = documentacion::all();
        $Pacientes = paciente::all();
        if($request->nombre != null) $Documentos = documentacion::where('nombre','like','%'.$request->nombre.'%')->get();
        return view('Documentacion.index',[
            'Documentos'=>$Documentos,
            'Pacientes'=>$Pacientes
        ]);
    }
    public function create(paciente $paciente){
        $Etiquetas = etiqueta::all();
        return view('Documentacion.create',[
            'paciente'=>$paciente,
            'Etiquetas'=>$Etiquetas
        ]);
    }
    public function store(Request $request, paciente $paciente){
        $request->validate([
            'archivo_nombre'=>'required',
            'archivo'=>'required'
        ]);
        $myTime = Carbon::now('America/La_Paz');
        $path = $request->file('archivo')->store('public/documentos');

        $documento = new documentacion();
        $documento->nombre = $request->input('archivo_nombre');
        $documento->fecha_registro = $myTime->toDateString();
        $documento->path = $path;
        $documento->user_id = Auth::user()->id;
        $documento->expediente_id = $paciente->expediente->id;
        $documento->save();

        $etiquetas = $request->input('etiquetas');
        if($etiquetas != null){
            foreach ($etiquetas as $etiqueta) {
                $etiqueta = etiqueta::find($etiqueta);
                $documentoEtiqueta = new documento_etiqueta();
                $documentoEtiqueta->etiqueta_id = $etiqueta->id;
                $documentoEtiqueta->documentacion_id = $documento->id;
                $documentoEtiqueta->save();
            }
        }
    
        $etiquetasAdded = $request->input('tagAdded');
        if($etiquetasAdded != null){
            foreach ($etiquetasAdded as $etiqueta) {
                $etiquetaAdded = new etiqueta();
                $etiquetaAdded->descripcion = $etiqueta;
                $etiquetaAdded->save();
                $documentoEtiqueta = new documento_etiqueta();
                $documentoEtiqueta->etiqueta_id = $etiquetaAdded->id;
                $documentoEtiqueta->documentacion_id = $documento->id;
                $documentoEtiqueta->save();
            }
        }
        

        return redirect()->route('expediente.paciente.index',['paciente'=>$paciente])->with('message','Documento registrado');
    }
    public function destroy(documentacion $documentacion){
        $paciente =  $documentacion->expediente->paciente;

        try{
            DB::beginTransaction();
            $DocEtiquetas = documento_etiqueta::where('documentacion_id',$documentacion->id)->get();
            if($DocEtiquetas != null){
                foreach($DocEtiquetas as $docEtiqueta){
                    $docEtiqueta->delete();
                }
            }
            $HistoriasClinica = historial_clinico::where('documentacion_id',$documentacion->id)->get();
            if($HistoriasClinica != null){
                foreach($HistoriasClinica as $historiaClinica){
                    $historiaClinica->delete();
                }
            }
            Storage::delete($documentacion->path);
            $documentacion->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors('No se puede eliminar, error de dependencia');
        }
        return redirect()->route('expediente.paciente.index',['paciente'=>$paciente])->with('message','Documento registrado');
    }
}
