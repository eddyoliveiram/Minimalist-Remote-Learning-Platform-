<?php

namespace App\Providers;

use App\Models\Course;
use App\Observers\CourseObserver;
use App\Repositories\CourseRepository;
use App\Services\CourseService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Course::observe(CourseObserver::class);
    }
}
