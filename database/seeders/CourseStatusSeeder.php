<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseStatus;

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
            ['id' => 2, 'description' => 'Ready'],
            ['id' => 3, 'description' => 'Finished'],
        ];

        foreach ($courseStatuses as $status) {
            CourseStatus::factory()->create($status);
        }
    }
}
