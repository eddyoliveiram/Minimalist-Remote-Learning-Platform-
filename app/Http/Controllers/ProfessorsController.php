<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessorRequest;
use App\Models\Professor;
use App\Repositories\ProfessorRepository;
use App\Services\ProfessorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfessorsController extends Controller
{
    public function __construct(
        protected ProfessorRepository $professorRepository,
        protected ProfessorService $professorService
    ) {
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
        $result = $this->professorService->store($request->validated());

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function show(Professor $professor)
    {
        //
    }

    public function edit(Professor $professor): View
    {
        return view('professors_edit', compact('professor'));
    }

    public function update(StoreProfessorRequest $request, Professor $professor): RedirectResponse
    {
//        $professor->update($request->validated());
//        return redirect()->back()->with('success', 'Professor updated successfully.');
        $result = $this->professorService->update($request->validated(), $professor->user);
        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function destroy(Professor $professor)
    {
        $result = $this->professorService->delete($professor);
        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }
}
