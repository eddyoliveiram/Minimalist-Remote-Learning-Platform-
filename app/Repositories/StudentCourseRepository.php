<?php

namespace App\Repositories;

use App\Contracts\CourseRepositoryInterface;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StudentCourseRepository implements CourseRepositoryInterface
{
    public function search($term, User $user): LengthAwarePaginator
    {
        $query = Course::with(['students.user', 'professors.user', 'modules']);

        if ($term) {
            $query->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('duration', 'LIKE', "%{$term}%");
            });
        }

        $result = $query->paginate(5);
        return $result;
    }
}
