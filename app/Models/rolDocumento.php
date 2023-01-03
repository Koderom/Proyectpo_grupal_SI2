<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rolDocumento extends Model
{
    use HasFactory;

    protected $table = 'rol_documentos';

    public function rol(){
        return $this->belongsTo(Role::class);
    }
    public function documentacion(){
        return $this->belongsTo(documentacion::class);
    }
}
