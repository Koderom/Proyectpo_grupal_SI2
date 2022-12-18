<?php

namespace App\Http\Controllers;

use App\Models\clinica;
use App\Models\documentacion;
use App\Models\documento_etiqueta;
use App\Models\etiqueta;
use App\Models\historial_clinico;
use App\Models\paciente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class historialClinicoController extends Controller
{
    
    private $AntecedentesPatologicos =['Diabetes','Hipertension','Colesterol_alto','Hepatitis_A', 'Hepatitis_B','Hepatitis_C','Problemas_del_higado','Pancreatitis','Insuficiencia_renal','Cancer','Depresion_o_ansiedad','Problemas_de_tiroides','Migrañas','Coagulo_de_sangre','Enfermedad_del_ceno','Alergias','Asma','Tuberculosis','VIH_o_Sida'];
    private $Alergias = ['Demerol','Lodo','Morfina','Propofol','Cinta_quirugica','Codeina','Fentanyl','Latex','Penincilina','Sulfa','Versed'];
    private $Heredofamiliares = [
        'Neoplastia','Tuberculosis','Diabetes','Artritis','Cardiopatias','Enfermedades_Neuronales','Transtornos_psiquiatricos','Enfermadades_respiratorias','Hepatopatias','Hipertension','Enfermedades_hematologicas','Enfermedades_endocrinologicas','Enfermedades_geneticas'
    ];
    private $GruposEtinicos =[
        'Americano_africano','Americano_Indio/Esquimal','Asitico/del_pacifico', 'Caucasico','Hispano/Latino', 'Multiracial'
    ];



    public function create(paciente $paciente){
        return view('HistorialClinico.create',[
            'paciente'=> $paciente,
            'AntecedentesPatologicos'=>collect($this->AntecedentesPatologicos),
            'Alergias'=>collect($this->Alergias),
            'Heredofamiliares'=>collect($this->Heredofamiliares),
            'GruposEtnicos'=>collect($this->GruposEtinicos)
        ]);
    }
    public function pdfGenerate(Request $request, paciente $paciente){
        //generacion del documento
        $myTime = Carbon::now('America/La_Paz');
        $cod = "".$myTime->year."".$myTime->month."".$myTime->day."".$myTime->minute."".$myTime->second."".$myTime->micro."";
        $doctor = Auth::user()->persona;//revisar quienes pueden registrar el HC
        $clinica = clinica::first();
        $pdf = Pdf::loadView('HistorialClinico.historialClinicoPDF',[
            'fecha_hora'=>$myTime,
            'doctor'=>$doctor,
            'paciente'=>$paciente,
            'clinica'=>$clinica,
            'formulario'=> $request,
            'AntecedentesPatologicos'=>collect($this->AntecedentesPatologicos),
            'Alergias'=>collect($this->Alergias),
            'Heredofamiliares'=>collect($this->Heredofamiliares),
            'GruposEtnicos'=>collect($this->GruposEtinicos),
            'HC_codigo'=>$cod
        ]);
        $hcpdf = $pdf->download('historialClinico.pdf');//<- documento
        // almacenamiento del documento
        $path = "documentos/HC".$cod.".pdf";
        Storage::disk('public')->put($path, $hcpdf);
        // guardar datos del documento en la base de datos
        $documento = new documentacion();
        $documento->nombre = "HistoriaClinica-".$cod;
        $documento->fecha_registro = $myTime->toDateString();
        $documento->path = 'public/'.$path;
        $documento->expediente_id = $paciente->expediente->id;
        $documento->user_id = Auth::user()->id;
        $documento->save();
        // guardar la HC en BD
        $historiaClinica = new historial_clinico();
        $historiaClinica->codigo = $cod;
        $historiaClinica->administrativo_id = $doctor->id;
        $historiaClinica->documentacion_id = $documento->id;
        $historiaClinica->save();
        // etiqueto del documento
        $etiqueta = etiqueta::where('descripcion','Historia clinica')->first();
        $documento_etiqueta = new documento_etiqueta();
        $documento_etiqueta->etiqueta_id = $etiqueta->id;
        $documento_etiqueta->documentacion_id = $documento->id;
        $documento_etiqueta->save();

        return redirect()->route('expediente.paciente.index',['paciente'=>$paciente])->with('message','Historia clinica registrada');
    }
}
