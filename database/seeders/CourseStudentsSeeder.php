<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CourseStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $courses = Course::all();
        $studentsIds = Student::pluck('id');

        $courses->each(function ($course) use ($studentsIds) {
            $course->students()->attach(
                $studentsIds->random(rand(1, 10))->toArray()
            );
        });
    }

}
