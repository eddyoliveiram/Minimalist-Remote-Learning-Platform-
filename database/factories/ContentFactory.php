<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $modulesIds = Module::pluck('id')->toArray();

        return [
            'position' => fake()->unique()->numberBetween(1, 1000),
            'type' => 'image',
            'local' => 'uploaded',
            'text_typed' => '',
            'file_uploaded' => fake()->imageUrl,
            'external_file_url' => '',
            'module_id' => fake()->randomElement($modulesIds),
        ];
    }
}
