<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::factory(10)->create()->each(function ($student) {
            $user = User::factory()->withPrefix('Std.')->create([
                'user_type' => 'student',
                'password' => '123'
            ]);

            $student->update(['user_id' => $user->id]);
        });
    }
}
