<?php

namespace App\Http\Controllers;

use App\Models\documentacion;
use App\Models\documento_etiqueta;
use App\Models\etiqueta;
use App\Models\expediente;
use App\Models\historial_clinico;
use App\Models\paciente;
use App\Models\persona;
use App\Models\rolDocumento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class documentacionController extends Controller
{
    private $Filtros = ['Nombre de documento','Etiqueta','Nombre paciente','Codigo de expediente','Registrado por...'];
    public function index(Request $request){
        $filtrar = null;
        $Documentos = documentacion::all();
        $Pacientes = paciente::all();
        if($request->texto_buscar != null){
            $filtrar = $request->filtrar;
            switch($filtrar){
                case 'Nombre de documento':
                    $Documentos = documentacion::where('nombre','like','%'.$request->texto_buscar.'%')->get();
                    break;
                case 'Etiqueta':
                    $tagsId = etiqueta::where('descripcion','like','%'.$request->texto_buscar.'%')->get();
                    $tagsId = $tagsId->map(function($item, $key){ return $item->id;});
                    $Documentos = documento_etiqueta::whereIn('etiqueta_id', $tagsId)
                    ->select('documento_etiquetas.documentacion_id')
                    ->groupBy('documento_etiquetas.documentacion_id')
                    ->get();
                    $Documentos = $Documentos->map(function($item, $key){ return $item->documentacion;});
                    break;
                case 'Nombre paciente':
                    $Personas = persona::where('nombre','like','%'.$request->texto_buscar.'%')
                    ->orWhere('apellido_paterno','like','%'.$request->texto_buscar.'%')
                    ->orWhere('apellido_materno','like','%'.$request->texto_buscar.'%')
                    ->get();
                    $personas_paciente = $Personas->where('tipo','P');
                    $codigosExpediente = $personas_paciente->map(function($item, $key){ return $item->paciente->expediente->id;});
                    $Documentos = documentacion::whereIn('expediente_id',$codigosExpediente)->get();
                    break;
                case 'Codigo de expediente':
                    $expedietes = expediente::where('codigo_registro','like','%'.$request->texto_buscar.'%')->get();
                    $expedietes = $expedietes->map(function($item, $key){ return $item->id;});
                    $Documentos = documentacion::whereIn('expediente_id',$expedietes)->get();
                    break;
                case 'Registrado por...':
                    $Personas = persona::where('nombre','like','%'.$request->texto_buscar.'%')
                    ->orWhere('apellido_paterno','like','%'.$request->texto_buscar.'%')
                    ->orWhere('apellido_materno','like','%'.$request->texto_buscar.'%')
                    ->get();
                    $regUserId = $Personas->map(function($item, $key){return $item->user->id;});
                    $Documentos = documentacion::whereIn('user_id',$regUserId)->get();
                    break;
            }
            if($Documentos->isEmpty()) return redirect()->route('documentacion.index')->withErrors('No existen documentos que coinsidad con el criterio de busqueda');
        }
        return view('Documentacion.index',[
            'filtrado_por'=>$filtrar,
            'Filtros'=>collect($this->Filtros),
            'Documentos'=>$Documentos,
            'Pacientes'=>$Pacientes
        ]);
    }
    public function create(paciente $paciente){
        $Etiquetas = etiqueta::all();
        $Roles = Role::all();
        return view('Documentacion.create',[
            'paciente'=>$paciente,
            'Etiquetas'=>$Etiquetas,
            'Roles'=>$Roles
        ]);
    }
    public function createDocumento(Request $request){
        $paciente = paciente::find($request->input('paciente'));
        return redirect()->route('documentacion.paciente.create',['paciente'=>$paciente]);
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

        $Roles = $request->input('rol');
        if($Roles != null){
            foreach($Roles as $rol){
                $rolDocumento = new rolDocumento();
                $rolDocumento->documentacion_id = $documento->id;
                $rolDocumento->role_id = $rol;
                $rolDocumento->save();
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
            return redirect()->back()->with('message','Eliminado exitosamente');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors('No se puede eliminar, error de dependencia');
        }
        return redirect()->route('expediente.paciente.index',['paciente'=>$paciente])->with('message','Documento registrado');
    }
    public function download(documentacion $documentacion){
        $usuario = Auth::user();
        $roles = $documentacion->rolDocumento;
        foreach($roles as $rol){
            $rolBloq = Role::findById($rol->role_id);
            if($usuario->hasRole($rolBloq->name)){
                return redirect()->back()->withErrors('No estas autorizado para ver este documento');
            }
        }
        return redirect(Storage::url($documentacion->path));
    }
}
