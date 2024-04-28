<?php

namespace Database\Seeders;

use App\Models\CourseStatus;
use Illuminate\Database\Seeder;

class CourseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseStatuses = [
            ['id' => 1, 'description' => 'Editing'],
            ['id' => 2, 'description' => 'Open'],
            ['id' => 3, 'description' => 'In Progress'],
            ['id' => 4, 'description' => 'Finished'],
        ];

        foreach ($courseStatuses as $status) {
            CourseStatus::factory()->create($status);
        }
    }
}
