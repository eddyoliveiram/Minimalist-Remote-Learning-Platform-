<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Request;

class CourseStructure extends Controller
{
    public ModuleRepository $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }
    

    public function edit(int $id, Request $request)
    {
        $course = Course::findOrFail($id);
        $modules = $this->moduleRepository->search($request->input('search'));
        return view('course_structure', compact('course', 'modules'));
    }


}
