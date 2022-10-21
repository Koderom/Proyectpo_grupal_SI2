<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoInternacion extends Model
{
    use HasFactory;

    protected $table = 'tipo_internacions';

    public function internacion(){
        return $this->hasMany(tipoInternacion::class);
    }
}
