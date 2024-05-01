<?php

namespace App\Http\Controllers;

use App\Contracts\StudentCourseRepositoryInterface;
use App\Models\Course;
use App\Repositories\ModuleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentViewController extends Controller
{
    public function __construct(
        protected StudentCourseRepositoryInterface $courseRepository,
        protected ModuleRepository $moduleRepository
    ) {
//        dd(get_class($this->courseRepository));
    }

    public function index(Request $request): View
    {
        $courses = $this->courseRepository->searchUnenrolled(
            $request->input('search'), auth()->user()
        );
        $courses_enrolled = $this->courseRepository->searchEnrolled(
            $request->input('search'), auth()->user()
        );

        return view('student_courses_list', compact('courses', 'courses_enrolled'));
    }

    public function show(Request $request)
    {
        $course = Course::findOrFail($request->input('course_id'));

        $modules = $this->moduleRepository->search($request->input('search'), $request->input('course_id'));
        return view('student_course_modules', compact('course', 'modules'));
    }

    public function enrollStudent(Course $course)
    {
        $studentId = auth()->user()->student->id;
        $course->students()->syncWithoutDetaching([$studentId]);

        return redirect()->back()->with('enroll_success', 'Successfully enrolled in the course!');
    }

    public function disenrollStudent(Course $course): RedirectResponse
    {
        $studentId = auth()->user()->student->id;
        $course->students()->detach($studentId);

        return redirect()->back()->with('disenroll_success', 'Successfully disenrolled from the course!');
    }
}
