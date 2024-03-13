<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'password' => '123',
            'email' => 'admin@gmail.com',
        ]);

        $this->call([
            CourseStatusSeeder::class,
            CourseSeeder::class,
            KnowledgeAreaSeeder::class,
            CourseKnowledgeAreaSeeder::class,
            ProfessorSeeder::class,
            StudentSeeder::class,
            CourseProfessorSeeder::class,
            CourseStudentsSeeder::class,
            ModuleSeeder::class
        ]);
    }
}
