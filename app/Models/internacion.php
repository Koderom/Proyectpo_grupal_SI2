<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class internacion extends Model
{
    use HasFactory;

    protected $table = 'internacions';

    public function tipoInternacion(){
        return $this->belongsTo(tipoInternacion::class);
    }
    public function sala(){
        return $this->belongsTo(sala::class);
    }
    public function cama(){
        return $this->hasMany(cama::class);
    }
}
