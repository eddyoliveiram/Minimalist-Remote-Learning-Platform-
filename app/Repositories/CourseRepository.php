<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CourseRepository
{
    public function search($term): LengthAwarePaginator
    {
        $query = Course::query();
        if ($term) {
            $query->where('name', 'LIKE', "%{$term}%")
                ->orWhere('duration', 'LIKE', "%{$term}%");
        }
        return $query->paginate(5);
    }
}
