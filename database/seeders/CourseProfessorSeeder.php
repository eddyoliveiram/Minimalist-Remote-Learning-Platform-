<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Professor;
use Illuminate\Database\Seeder;

class CourseProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $courses = Course::all();
        $professorIds = Professor::pluck('id');

        $courses->each(function ($course) use ($professorIds) {
            $course->professors()->attach(
                $professorIds->random(rand(1, 5))->toArray()
            );
        });
    }

}
