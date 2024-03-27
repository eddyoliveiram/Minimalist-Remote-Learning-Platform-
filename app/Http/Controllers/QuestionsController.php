<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionsController extends Controller
{
    public function __construct(protected QuestionRepository $questionRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $module_id = $request->input('module_id');
        $questions = $this->questionRepository->search($request->input('search'), $module_id);
        return view('questions_index', compact('questions', 'module_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
//        $module_id = $request->input('module_id');
        $module_id = $request->query('module_id');
        return view('questions_create', compact('module_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        Question::create($request->validated());
        return redirect()->back()->with('success', 'Question created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('questions_edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQuestionRequest $request, Question $question)
    {
        $question->update($request->validated());
        return redirect()->back()->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back()->with('success', 'Question deleted successfully.');
    }
}
