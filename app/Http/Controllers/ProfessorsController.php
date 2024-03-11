<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessorRequest;
use App\Models\Professor;
use App\Repositories\ProfessorRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfessorsController extends Controller
{
    protected ProfessorRepository $professorRepository;

    public function __construct(ProfessorRepository $professorRepository)
    {
        $this->professorRepository = $professorRepository;
    }

    public function index(Request $request): View
    {
        $professors = $this->professorRepository->search($request->input('search'));
//        $professors = Professor::paginate(5);
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
