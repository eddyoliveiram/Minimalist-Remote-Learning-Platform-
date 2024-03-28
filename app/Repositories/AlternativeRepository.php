<?php

namespace App\Repositories;

use App\Models\Alternative;

class AlternativeRepository
{
    public function search($term, $question_id)
    {
        $query = Alternative::query();

        if ($question_id) {
            $query->where('question_id', $question_id);
        }

        if (!empty($term)) {
            $query->where('description', 'LIKE', "%{$term}%");
        }

        return $query->paginate(5)->appends(['question_id' => $question_id]);
    }
}
