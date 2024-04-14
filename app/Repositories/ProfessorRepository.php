<?php

namespace App\Repositories;

use App\Models\Professor;

class ProfessorRepository
{
    public function search($term)
    {
        $query = Professor::with([
            'user' => function ($query) {
                $query->where('user_type', 'professor');
            }
        ]);

        if ($term) {
            $query->whereHas('user', function ($q) use ($term) {
                $q->where('name', 'LIKE', "%{$term}%");
            });
        }
        return $query->paginate(5);
    }
}
