<?php

namespace Database\Seeders;

use App\Models\tipoInternacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipoInternacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tipoInternacion::create(['descripcion' => 'Internacion Clinica']);
        tipoInternacion::create(['descripcion' => 'Internacion breve']);
        tipoInternacion::create(['descripcion' => 'Internacion para Quimioterapia o goteo']);
        tipoInternacion::create(['descripcion' => 'Internacion pre-transplante']);
        tipoInternacion::create(['descripcion' => 'Internaicon post-transplante']);
        tipoInternacion::create(['descripcion' => 'Internacion geriatrica']);
        tipoInternacion::create(['descripcion' => 'Internacion quirugica']);
    }
}
