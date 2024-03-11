<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\KnowledgeArea;
use Illuminate\Database\Seeder;

class CourseKnowledgeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        $knowledgeAreas = KnowledgeArea::all();

        foreach ($courses as $course) {
            $selectedKnowledgeAreas = $knowledgeAreas->random(rand(2,4));
            $course->knowledgeAreas()->attach($selectedKnowledgeAreas);
        }
    }
}
