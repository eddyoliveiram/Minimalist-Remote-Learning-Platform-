<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentsController extends Controller
{

    public function __construct(public StudentRepository $studentRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): view
    {
        $students = $this->studentRepository->search($request->input('search'));

        return view('students_index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        return view('students_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        Student::create($request->validated());
        return redirect()->back()->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        return view('students_edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());
        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->destroy($student->id);
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }
}
