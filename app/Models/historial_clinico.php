<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class historial_clinico extends Model
{
    use HasFactory;

    protected $table = 'historial_clinicos';

    public function documentacion(){
        return $this->belongsTo(documentacion::class);
    }
    public function administrativo(){
        return $this->belongsTo(administrativo::class);
    }
}
