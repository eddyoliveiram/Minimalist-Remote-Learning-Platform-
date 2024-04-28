<?php

namespace App\Repositories;

use App\Contracts\StudentCourseRepositoryInterface;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StudentCourseRepository implements StudentCourseRepositoryInterface
{
    public function searchUnenrolled($term, User $user): LengthAwarePaginator
    {
        $query = Course::with(['students.user', 'professors.user', 'modules', 'professors', 'status'])
            ->whereDoesntHave('students', function ($query) use ($user) {
                $query->where('students.id', $user->student->id);
            });

        if ($term) {
            $query->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('duration', 'LIKE', "%{$term}%");
            });
        }

        $result = $query->paginate(5);
        return $result;
    }

    public function searchEnrolled($term, User $user): LengthAwarePaginator
    {
        $query = Course::with(['students.user', 'professors.user', 'modules', 'professors', 'status'])
            ->whereHas('students', function ($query) use ($user) {
                $query->where('students.id', $user->student->id);
            });


        if ($term) {
            $query->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('duration', 'LIKE', "%{$term}%");
            });
        }

        return $query->paginate(5);
    }

}
