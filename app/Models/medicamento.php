<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicamento extends Model
{
    use HasFactory;
    protected $table="medicamentos";
    public function medicamento_receta()
    {
        return $this->hasMany(medicamento_receta::class);
    }
}

