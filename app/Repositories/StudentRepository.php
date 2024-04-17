<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function search($term)
    {
        $query = Student::with([
            'user' => function ($filter) {
                $filter->where('user_type', 'student');
            }
        ]);


        if ($term) {
            $query->whereHas('user', function ($q) use ($term) {
                $q->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('email', 'LIKE', "%{$term}%")
                    ->orWhere('phone', 'LIKE', "%{$term}%");
            });
        }

//        dd($query->get());
        return $query->paginate(5);
    }
}
