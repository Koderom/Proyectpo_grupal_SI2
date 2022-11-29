<?php

namespace App\Http\Controllers;

use App\Models\clinica;
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
        //return $request;
        $myTime = Carbon::now('America/La_Paz');
        $doctor = Auth::user()->persona;
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
            'GruposEtnicos'=>collect($this->GruposEtinicos)

        ]);
        $hcpdf = $pdf->download('historialClinico.pdf');
        $path = "documentos/HC"."holamundo".".pdf";
        $documento = Storage::disk('public')->put($path, $hcpdf);
        return $pdf->download('historialClinico.pdf');

    }
}
