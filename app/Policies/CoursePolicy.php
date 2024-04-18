<?php

declare(strict_types=1);

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
        if ($user->is_admin) {
            return true;
        }

        $user->loadMissing('professor.courses');

        if ($user->professor && $user->professor->courses->contains($course)) {
            return true;
        }

        return false;
    }
}
