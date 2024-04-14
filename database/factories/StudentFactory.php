<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'fix it later',
            'registration' => 'SR'.uniqid('', true),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber,
            'user_id' => User::factory()
        ];
    }
}
