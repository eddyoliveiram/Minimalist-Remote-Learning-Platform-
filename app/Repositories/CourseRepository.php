<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class CourseRepository
{
    public function search($term, User $user): LengthAwarePaginator
    {
        $query = Course::with(['students.user', 'professors.user', 'modules']);

        if ($user->user_type != 'admin') {
            $query->whereHas('professors', function ($query) use ($user) {
                $query->where('user_id', $user->id);
                \Log::info('Query Professors for User ID: '.$user->id);
            });
        }

        if ($term) {
            $query->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('duration', 'LIKE', "%{$term}%");
            });
        }

        $result = $query->paginate(5);
        \Log::info('Query Result: ', ['result' => $result]);
        return $result;
    }

    public function searchForStudent($term): LengthAwarePaginator
    {
        $query = Course::with(['students.user', 'professors.user', 'modules']);

        if ($term) {
            $query->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('duration', 'LIKE', "%{$term}%");
            });
        }

        $result = $query->paginate(5);
        \Log::info('Query Result: ', ['result' => $result]);
        return $result;
    }

}
