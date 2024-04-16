<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Professor;
use App\Models\Student;
use App\Observers\CourseObserver;
use App\Observers\ProfessorObserver;
use App\Observers\StudentObserver;
use App\Repositories\ContentRepository;
use App\Repositories\CourseRepository;
use App\Services\CourseService;
use App\Services\Interfaces\ContentRepositoryInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CourseService::class, function () {
            return new CourseService();
        });

        $this->app->bind(CourseRepository::class, function () {
            return new CourseRepository();
        });

        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Course::observe(CourseObserver::class);
        Student::observe(StudentObserver::class);
        Professor::observe(ProfessorObserver::class);

        Blade::if('AdminOrProf', function () {
            return auth()->check() && (auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'professor');
        });
    }
}
