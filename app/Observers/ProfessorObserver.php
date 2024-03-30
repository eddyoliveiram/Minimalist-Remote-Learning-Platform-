<?php

namespace App\Observers;

use App\Models\Professor;

class ProfessorObserver
{

    public function creating(Professor $professor): void
    {
        $professor->registration = 'PR'.time().rand(1000, 9999);
    }

    /**
     * Handle the Professor "created" event.
     */
    public function created(Professor $professor): void
    {
        //
    }

    /**
     * Handle the Professor "updated" event.
     */
    public function updated(Professor $professor): void
    {
        //
    }

    /**
     * Handle the Professor "deleted" event.
     */
    public function deleted(Professor $professor): void
    {
        //
    }

    /**
     * Handle the Professor "restored" event.
     */
    public function restored(Professor $professor): void
    {
        //
    }

    /**
     * Handle the Professor "force deleted" event.
     */
    public function forceDeleted(Professor $professor): void
    {
        //
    }
}
