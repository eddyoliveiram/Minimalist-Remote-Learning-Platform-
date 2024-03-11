<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public function createCourse(array $validatedData, $image = null)
    {
        if ($image) {
            $path = $image->store('images', 'public');
            $validatedData['image'] = $path;
        }

        return Course::create($validatedData);
    }

    public function updateCourse($courseId, array $validatedData, $image = null)
    {
        $course = Course::findOrFail($courseId);
        if ($image) {
            $path = $image->store('images', 'public');
            $validatedData['image'] = $path;
        }

        $course->update($validatedData);

        return $course;
    }
}
