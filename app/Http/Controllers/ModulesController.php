<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Request;

class ModulesController extends Controller
{

    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function index(Request $request)
    {
        $course = Course::findOrFail($request->input('course_id'));
        $modules = $this->moduleRepository->search($request->input('search'), $request->input('course_id'));
        return view('modules_index', compact('course', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::paginate(6);
        return view('modules_create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        //
    }
}
