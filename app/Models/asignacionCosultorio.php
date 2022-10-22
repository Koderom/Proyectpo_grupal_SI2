<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class asignacionCosultorio extends Model
{
    use HasFactory;

    protected $table = 'asignacion_consultorios';

    public function consultorio(){
        return $this->belongsTo(consultorio::class);
    }
    public function doctor(){
        return $this->belongsTo(doctor::class);
    }
}
