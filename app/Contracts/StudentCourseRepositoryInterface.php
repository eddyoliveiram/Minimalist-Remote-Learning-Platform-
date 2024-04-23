<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface StudentCourseRepositoryInterface
{
    public function searchEnrolled($term, User $user): LengthAwarePaginator;

    public function searchUnenrolled($term, User $user): LengthAwarePaginator;
}
