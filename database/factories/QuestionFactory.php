<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->name.'?',
            'type' => fake()->randomElement(['OBJECTIVE', 'SUBJECTIVE']),
            'module_id' => fake()->randomElement(Module::pluck('id')->toArray()),
        ];
    }
}
