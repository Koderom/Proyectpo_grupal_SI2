<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documento_etiqueta extends Model
{
    use HasFactory;
    protected $table = 'documento_etiquetas';

    public function etiqueta(){
        return $this->belongsTo(etiqueta::class);
    }
    public function documentacion(){
        return $this->belongsTo(documentacion::class);
    }
}

