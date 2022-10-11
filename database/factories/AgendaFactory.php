<?php

namespace Database\Factories;

use App\Models\agenda;
use App\Models\doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class agendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = agenda::class;
    public function definition()
    {
        
        return [
            'fecha'=> fake()->randomElement(['2022-11-01','2022-12-01','2022-11-02','2022-11-03','2022-11-04','2022-11-05','2022-10-08']),
            'doctor_id'=> doctor::factory(),
        ];
    }
    
}
