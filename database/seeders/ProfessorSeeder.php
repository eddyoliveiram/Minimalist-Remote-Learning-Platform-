<?php

namespace Database\Seeders;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Professor::factory(10)->create()->each(function ($professor) {
            $user = User::factory()->withPrefix('Prof.')->create([
                'user_type' => 'professor',
                'password' => '123'
            ]);

            $professor->update(['user_id' => $user->id]);
        });
    }
}
