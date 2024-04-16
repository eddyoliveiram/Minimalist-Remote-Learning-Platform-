<?php

namespace App\Providers;

use App\Contracts\CourseRepositoryInterface;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentViewController;
use App\Repositories\ContentRepository;
use App\Repositories\CourseRepository;
use App\Repositories\StudentCourseRepository;
use App\Services\Interfaces\ContentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->when(CoursesController::class)
            ->needs(CourseRepositoryInterface::class)
            ->give(CourseRepository::class);

        $this->app->when(StudentViewController::class)
            ->needs(CourseRepositoryInterface::class)
            ->give(StudentCourseRepository::class);
    }
}
