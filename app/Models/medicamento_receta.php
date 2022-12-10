<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicamento_receta extends Model
{
    use HasFactory;
    protected $table='medicamento_recetas';
    public function receta()
    {
        return $this->belongsTo(receta::class);
    }
    public function medicamento()
    {
        return $this->belongsTo(medicamento::class);
    }
}
