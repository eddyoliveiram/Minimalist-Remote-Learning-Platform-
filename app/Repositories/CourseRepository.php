<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function search($term)
    {
        $query = Course::query();
        if ($term) {
            $query->where('name', 'LIKE', "%{$term}%")
                ->orWhere('duration', 'LIKE', "%{$term}%");
        }
        return $query->paginate(5);
    }
}
