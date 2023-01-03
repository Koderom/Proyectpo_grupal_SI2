<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documentacion extends Model
{
    use HasFactory;
    
    protected $table = 'documentacions';

    public function documentoEtiqueta(){
        return $this->hasMany(documento_etiqueta::class);
    }
    public function expediente(){
        return $this->belongsTo(expediente::class);
    }
    public function historialClinico(){
        return $this->hasMany(historial_clinico::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function rolDocumento(){
        return $this->hasMany(rolDocumento::class);
    }
}
