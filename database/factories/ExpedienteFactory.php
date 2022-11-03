<?php

namespace Database\Factories;

use App\Models\expediente;
use App\Models\paciente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expediente>
 */
class ExpedienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = expediente::class;
    public function definition()
    {
        return [
            'codigo_registro'=>fake()->unique()->Str::random(6),
            'fecha_registro'=>fake()->date(),
            'paciente_id'=>paciente::factory(),
        ];
    }
}
