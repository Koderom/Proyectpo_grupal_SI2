<?php

namespace Database\Seeders;

use App\Models\etiqueta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class etiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        etiqueta::create(['descripcion'=>'Historia clinica']);
        etiqueta::create(['descripcion'=>'Receta']);
        etiqueta::create(['descripcion'=>'Registro de consulta']);
    }
}
