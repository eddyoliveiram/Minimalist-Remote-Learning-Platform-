<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    public function search($term, $course)
    {
        $query = Module::with('contents')
            ->where('course_id', $course);
        $query->where('course_id', $course);
        if ($term) {
            $query->where('name', 'LIKE', "%{$term}%");
        }
        return $query->paginate(5)->appends(['course_id' => $course]);
    }
}
