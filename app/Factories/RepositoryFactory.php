<?php

namespace App\Factories;

use App\Contracts\CourseRepositoryInterface;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\Auth;

class RepositoryFactory
{
    public static function create(): CourseRepositoryInterface
    {
        if (Auth::check() && Auth::user()->user_type == 'student') {
            return new CourseRepository();
        } else {
            return new CourseRepository();
        }
    }
}
