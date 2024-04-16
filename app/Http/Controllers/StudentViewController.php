<?php

namespace App\Http\Controllers;

use App\Contracts\CourseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentViewController extends Controller
{
    public function __construct(
        protected CourseRepositoryInterface $courseRepository
    ) {
    }

    public function index(Request $request): View
    {
        $courses = $this->courseRepository->search(
            $request->input('search'), auth()->user()
        );
        return view('student_dashboard', compact('courses'));
    }
}
