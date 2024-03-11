<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessorRequest;
use App\Models\Professor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfessorsController extends Controller
{
    public function index(): View
    {
        $professors = Professor::paginate(5);
        return view('professors_index', compact('professors'));
    }

    public function create(): View
    {
        return view('professors_create');
    }

    public function store(StoreProfessorRequest $request): RedirectResponse
    {
        Professor::create($request->validated());
        return redirect()->back()->with('success', 'Professor created successfully.');
    }

    public function show(Professor $professor)
    {
        //
    }

    public function edit(Professor $professor)
    {
        return view('professors_edit', compact('professor'));
    }

    public function update(StoreProfessorRequest $request, Professor $professor): RedirectResponse
    {
        $professor->update($request->validated());
        return redirect()->back()->with('success', 'Professor updated successfully.');
    }

    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect()->back()->with('success', 'Professor deleted successfully.');
    }
}
