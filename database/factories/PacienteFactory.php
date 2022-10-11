<?php

namespace Database\Factories;

use App\Models\paciente;
use App\Models\persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class pacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = paciente::class;
    public function definition()
    {
        return [
            'nombre_tutor'=> fake()->name(),
            'numero_telefono_tutor'=>fake()->randomNumber(8,true),
            'persona_id'=> persona::factory(),
        ];
    }
}
