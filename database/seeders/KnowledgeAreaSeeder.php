<?php

namespace Database\Seeders;

use App\Models\KnowledgeArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KnowledgeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $knowledgeAreas = [
            ['id' => 1, 'description' => 'Administration'],
            ['id' => 2, 'description' => 'Natural Sciences'],
            ['id' => 3, 'description' => 'Human Sciences'],
            ['id' => 4, 'description' => 'Education'],
            ['id' => 5, 'description' => 'Languages'],
            ['id' => 6, 'description' => 'Mathematics'],
            ['id' => 7, 'description' => 'Health']
        ];

        foreach ($knowledgeAreas as $area) {
            KnowledgeArea::factory()->create($area);
        }
    }
}
