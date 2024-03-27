<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository
{
    public function search($term, $module)
    {
        $query = Question::with('alternatives');

        if ($module) {
            $query->where('module_id', $module);
        }

        if (!empty($term)) {
            $query->where('description', 'LIKE', "%{$term}%");
        }

        return $query->paginate(5)->appends(['module_id' => $module]);
    }
}
