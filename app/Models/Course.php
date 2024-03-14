<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'duration', 'start_date', 'end_date', 'status_id', 'vacancies', 'image'
    ];

    public function scopeSearch($query, $term): void
    {
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('duration', 'LIKE', "%{$term}%");
            });
        }
    }

    public function knowledgeAreas(): BelongsToMany
    {
        return $this
            ->belongsToMany(KnowledgeArea::class, 'course_knowledge_area')
            ->withTimestamps();
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(CourseStatus::class, '');
    }

    public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class, 'course_professor')
            ->withTimestamps();
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_student')
            ->withTimestamps();
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class, 'course_id');
    }


}
