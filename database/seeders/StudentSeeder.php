<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = User::factory()->asStudent()->create([
                'password' => '123'
            ]);
            Student::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
