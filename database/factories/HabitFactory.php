<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $habits = [
            'Ler 10 paginas',
            'Ir a academia',
            'Beber 2 litros de água',
            'Estudar por 1 hora'
        ];
        return [
            'user_id' => 1,
            'name' => fake()->unique()->randomElement($habits)
        ];
    }
}
