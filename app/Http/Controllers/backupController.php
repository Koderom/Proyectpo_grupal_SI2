<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class backupController extends Controller
{
    public function create(){
        return exec('C:\xampp\htdocs\DoClinic\public\backup\backup_doclinic.bat');
    }
    public function restore(){

    }
}
