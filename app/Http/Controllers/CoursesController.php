<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Models\CourseStatus;
use App\Models\KnowledgeArea;
use App\Models\Professor;
use App\Repositories\CourseRepository;
use App\Services\CourseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CoursesController extends Controller
{
    public function __construct(
        protected CourseService $courseService,
        protected CourseRepository $courseRepository
    ) {
    }

    public function index(Request $request): View
    {
        $courses = $this->courseRepository->search(
            $request->input('search'), auth()->user()
        );
        return view('courses_index', compact('courses'));
    }

    public function create(): View
    {
        $knowledge_areas = KnowledgeArea::all();
        $query = Professor::with([
            'user' => function ($query) {
                $query->where('user_type', 'professor');
            }
        ]);
        $professors = $query->get();
        return view('courses_create', compact('knowledge_areas', 'professors'));
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $this->courseService->createCourse($request->validated(), $request->file('image'));
        return redirect()->back()->with('success', 'Course created successfully.');
    }

    public function edit($id): View
    {
        $course = Course::with('knowledgeAreas')->findOrFail($id);
        $knowledge_areas = KnowledgeArea::all();
        $statuses = CourseStatus::all();
        $professors = Professor::all();
        return view('courses_edit', compact(
            'course', 'knowledge_areas', 'statuses', 'professors'
        ));
    }

    public function update(StoreCourseRequest $request, $id): RedirectResponse
    {
        $this->courseService->updateCourse($id, $request->validated(), $request->file('image'));
        return redirect()->back()->with('success', 'Course updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted successfully.');
    }

    public function apiCourses($status = null)
    {
        $query = Course::query();

        if (!is_null($status)) {
            $query->where('status', $status);
        }

        $courses = $query->limit(10)->get(['id', 'name']);

        return response()->json($courses);
    }
}
