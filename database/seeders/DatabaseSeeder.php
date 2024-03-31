<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseStatusSeeder::class,
            CourseSeeder::class,
            KnowledgeAreaSeeder::class,
            CourseKnowledgeAreaSeeder::class,
            ProfessorSeeder::class,
            StudentSeeder::class,
            CourseProfessorSeeder::class,
            CourseStudentsSeeder::class,
            ModuleSeeder::class,
            ContentSeeder::class,
            QuestionSeeder::class,
            AlternativeSeeder::class
        ]);
    }
}
