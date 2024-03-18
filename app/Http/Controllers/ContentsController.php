<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Models\Content;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $module = Module::findOrfail($request->input('module_id'));
        $contents = Content::where('module_id', $request->input('module_id'))->get();
        return view('contents_index', compact('module', 'contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $module_id = $request->input('module_id');
        return view('contents_create', compact('module_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContentRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('file_uploaded') && ($request->type === 'image' || $request->type === 'document')) {
            $filePath = $request->file('file_uploaded')->store('contents', 'public');
            $validatedData['file_uploaded'] = $filePath;
        }

        Content::create($validatedData);
        return redirect()->back()->with('success', 'Content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        //
    }
}
