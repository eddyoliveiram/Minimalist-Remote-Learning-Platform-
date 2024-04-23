<?php

namespace App\Http\Controllers;

use App\Contracts\StudentCourseRepositoryInterface;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentViewController extends Controller
{
    public function __construct(
        protected StudentCourseRepositoryInterface $courseRepository
    ) {
//        dd(get_class($this->courseRepository));
    }

    public function index(Request $request): View
    {
        $courses = $this->courseRepository->searchUnenrolled(
            $request->input('search'), auth()->user()
        );
        return view('student_courses_list', compact('courses'));
    }

    public function enrollStudent(Course $course)
    {
        $studentId = auth()->user()->student->id;
        $course->students()->syncWithoutDetaching([$studentId]);

        return redirect()->back()->with('success', 'Successfully enrolled in the course!');
    }
}
