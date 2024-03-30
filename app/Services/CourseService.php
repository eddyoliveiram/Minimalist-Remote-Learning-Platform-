<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public function createCourse(array $validatedData, $image = null): Course
    {
        if ($image) {
            $path = $image->store('images', 'public');
            $validatedData['image'] = $path;
        }

        $course = Course::create($validatedData);

        $course->knowledgeAreas()->attach($validatedData['areas']);
        $course->professors()->attach($validatedData['professors']);

        return $course;
    }

    public function updateCourse($courseId, array $validatedData, $image = null): Course
    {
        $course = Course::findOrFail($courseId);
        if ($image) {
            $path = $image->store('images', 'public');
            $validatedData['image'] = $path;
        }

        $course->update($validatedData);
        $course->knowledgeAreas()->sync($validatedData['areas']);
        $course->professors()->sync($validatedData['professors']);

        return $course;
    }
}
