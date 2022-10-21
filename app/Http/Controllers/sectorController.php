<?php

namespace App\Http\Controllers;

use App\Models\sector;
use Illuminate\Http\Request;

class sectorController extends Controller
{
    public function index(){
        $Sectores = sector::all();
        return view('Sector.index',['Sectores'=>$Sectores]);
    }
}
