<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Course;
use Illuminate\Support\Facades\App;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        if (App::runningInConsole() || App::runningUnitTests() || App::environment('sail')) {
            return; // Don't do anything in migration process
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'created',
            'model_affected' => get_class($course),
            'after' => $course->toJson(),
        ]);
    }

    public function updated(Course $course): void
    {
        if (App::runningInConsole() || App::runningUnitTests() || App::environment('sail')) {
            return; // Don't do anything in migration process
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'model_affected' => get_class($course),
            'before' => json_encode($course->getOriginal()),
            'after' => $course->toJson(),
        ]);
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        //
    }
}
