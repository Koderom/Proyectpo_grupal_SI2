<?php

namespace App\Http\Controllers;

use App\Models\clinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class reporteController extends Controller
{
    private $Tablas = ['users','personas','doctors','administrativos','pacientes'];

    public function index(){
        return view('Reporte.index',[
            'Tablas' => collect($this->Tablas)
        ]);
    }
    public function create(Request $request){
        $tablaContenido = DB::table($request->tabla)->orderby('id')->get();
        $Columnas = collect($tablaContenido->first())->keys();
        //return $tablaContenido;
        return view('Reporte.index',[
            'Tablas' => collect($this->Tablas),
            'tablaContenido' => $tablaContenido,
            'Columnas' => $Columnas,
            'tablaSeleccionada' => $request->tabla
        ]);
    }
    public function pdfGenerate(Request $request){
        //try{
            //columnas a mostrar
            $columnasAMostrar = "";
            foreach($request->columnas as $col){
                $columnasAMostrar = $columnasAMostrar.",".$col;
            }
            $columnasAMostrar = substr($columnasAMostrar,1);
            //generar consulta
            $tablaContenido = DB::table($request->tabla)
            ->select(DB::raw($columnasAMostrar))
            ->orderby($request->ordenarPor, $request->ordenar)
            ->limit($request->filas)
            ->get();
            // filtrado
            if($request->filtrarVal != null){
                if($request->filtrarOP == "like"){
                    $tablaContenido = DB::table($request->tabla)
                    ->select(DB::raw($columnasAMostrar))
                    ->orderby($request->ordenarPor, $request->ordenar)
                    ->limit($request->filas)
                    ->where($request->filtrarPor,'like','%'.$request->filtrarVal.'%')
                    ->get();
                }else{
                    $tablaContenido = $tablaContenido->where($request->filtrarPor,$request->filtrarOP,$request->filtrarVal);
                }
            }
            //generar pdf
            $Columnas = collect($tablaContenido->first())->keys();
            $pdf = Pdf::loadView('Reporte.pdfGenerate',[
                'tablaContenido' => $tablaContenido,
                'Columnas' => $Columnas,
                'titulo' => $request->titulo,
                'clinica' => clinica::first()
            ]);
            return $pdf->download();
        // }catch(Exception $e){
        //     return "errores";
        // }
    }
}
