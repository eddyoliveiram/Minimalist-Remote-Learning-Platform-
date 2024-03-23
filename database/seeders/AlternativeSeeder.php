<?php

namespace Database\Seeders;

use App\Models\Alternative;
use App\Models\Question;
use Illuminate\Database\Seeder;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();

        foreach ($questions as $question) {
            if ($question->type === 'OBJECTIVE') {
                $alternatives = Alternative::factory()
                    ->count(rand(4, 5))
                    ->create(['question_id' => $question->id]);
                $alternatives->random()->update(['right_one' => true]);
            }
        }
//        Alternative::factory(10)->create();
    }
}
