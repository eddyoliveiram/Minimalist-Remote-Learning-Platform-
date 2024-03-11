<?php

namespace Database\Factories;

use App\Models\CourseStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => "Course Example ".fake()->numberBetween(1,1000),
            'duration' => fake()->numberBetween(20,100),
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(rand(1,30))->format('Y-m-d'),
            'status_id' => CourseStatus::pluck('id')->random(),
            'vacancies' =>  rand(20, 500)
        ];
    }
}
