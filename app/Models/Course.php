<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'duration', 'start_date', 'end_date', 'status_id', 'vacancies', 'image'
    ];

    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('duration', 'LIKE', "%{$term}%");
            });
        }
    }

    public function status()
    {
        return $this->belongsTo(CourseStatus::class, '');
    }

    public function knowledgeAreas()
    {
        return $this
            ->belongsToMany(KnowledgeArea::class, 'course_knowledge_area')
            ->withTimestamps();
    }
}
