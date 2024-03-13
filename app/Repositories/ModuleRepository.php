<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    public function search($term)
    {
        $query = Module::query();
        if ($term) {
            $query->where('name', 'LIKE', "%{$term}%");
        }
        return $query->paginate(5);
    }
}
