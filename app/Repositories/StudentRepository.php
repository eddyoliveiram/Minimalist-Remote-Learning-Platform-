<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function search($term)
    {
        $query = Student::query();
        if ($term) {
            $query->where('name', 'LIKE', "%{$term}%")
                ->orWhere('registration', 'LIKE', "%{$term}%")
                ->orWhere('email', 'LIKE', "%{$term}%")
                ->orWhere('phone', 'LIKE', "%{$term}%");
        }
        return $query->paginate(5);
    }
}
