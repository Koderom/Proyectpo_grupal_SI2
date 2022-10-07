<?php

namespace Database\Seeders;

use App\Models\administrativo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class administrativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        administrativo::create([
            //'id'=>1,
            'persona_id'=>1,
            'cargo'=>'Administrador'
        ]);
    }
}
