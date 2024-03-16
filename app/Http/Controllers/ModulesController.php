<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Models\Course;
use App\Models\Module;
use App\Repositories\ModuleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModulesController extends Controller
{
    private ModuleRepository $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function index(Request $request): View
    {
        $course = Course::findOrFail($request->input('course_id'));
        $modules = $this->moduleRepository->search($request->input('search'), $request->input('course_id'));
        return view('modules_index', compact('course', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $course_id = $request->input('course_id');
        $modules = Module::paginate(6);
        return view('modules_create', compact('modules', 'course_id'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request): RedirectResponse
    {
        Module::create($request->all());
        return redirect()->route(
            'modules.index', ['course_id' => $request->input('course_id')]
        )->with('success', 'Module created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module): View
    {
        $course_id = $module->course_id;
        return view('modules_edit', compact('module', 'course_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreModuleRequest $request, Module $module): RedirectResponse
    {
        $module->update($request->validated());
        return redirect()->back()->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module): RedirectResponse
    {
        $module->delete();
        return redirect()->back()->with('success', 'Module deleted successfully.');
    }
}
