<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeArea extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this
            ->belongsToMany(Course::class, 'course_knowledge_area');
    }
}
