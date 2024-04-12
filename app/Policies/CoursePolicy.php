<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function viewAny()
    {
        return auth()->check();
    }

    public function view(User $user, Course $course)
    {
        return $user->is_admin || $user->courses->contains($course->id);
    }
}
