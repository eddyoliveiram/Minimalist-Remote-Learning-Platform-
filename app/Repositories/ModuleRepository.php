<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    public function search($term, $course)
    {
        $query = Module::query();
        $query->where('course_id', $course);
        if ($term) {
            $query->where('name', 'LIKE', "%{$term}%");
        }
        return $query->paginate(5);
    }
}
