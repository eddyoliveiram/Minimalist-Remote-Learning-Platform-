<?php

namespace App\Repositories;

use App\Models\Professor;

class ProfessorRepository
{
    public function search($term)
    {
        $query = Professor::query();
        if ($term) {
            $query->where('name', 'LIKE', "%{$term}%")
                ->orWhere('registration', 'LIKE', "%{$term}%");
        }
        return $query->paginate(5);
    }
}
