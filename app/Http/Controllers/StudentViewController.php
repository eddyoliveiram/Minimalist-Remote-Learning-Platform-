<?php

namespace App\Http\Controllers;

use App\Repositories\CourseRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentViewController extends Controller
{
    public function __construct(
        protected CourseRepository $courseRepository
    ) {
    }

    public function index(Request $request): View
    {
        $courses = $this->courseRepository->searchForStudent(
            $request->input('search')
        );
        return view('student_dashboard', compact('courses'));
    }
}
