<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlternativeRequest;
use App\Models\Alternative;
use App\Repositories\AlternativeRepository;
use Illuminate\Http\Request;

class AlternativesController extends Controller
{

    public function __construct(protected AlternativeRepository $alternativeRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $question_id = $request->input('question_id');


        $alternatives = $this->alternativeRepository->search($request->input('search'), $question_id);
        return view('alternatives_index', compact('alternatives', 'question_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $question_id = $request->query('question_id');
        return view('alternatives_create', compact('question_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlternativeRequest $request)
    {
        Alternative::create($request->validated());

        return redirect()->route(
            'alternatives.index', ['question_id' => $request->input('question_id')]
        )->with('success', 'Alternative created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternative $alternative)
    {
        return view('alternative_edit', compact('alternative'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAlternativeRequest $request, Alternative $alternative)
    {
        $alternative->update($request->validated());
        return redirect()->back()->with('success', 'Alternative updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternative $alternative)
    {
        $alternative->delete();
        return redirect()->back()->with('success', 'Alternative deleted successfully.');
    }
}
