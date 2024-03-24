<?php

namespace App\Services;

use App\Http\Requests\StoreContentRequest;
use App\Models\Content;
use App\Services\Interfaces\ContentRepositoryInterface;
use App\Services\Interfaces\ContentServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ContentService implements ContentServiceInterface
{

    public function __construct(protected ContentRepositoryInterface $contentRepository)
    {
    }

    public function updateContent(StoreContentRequest $request, Content $content): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($content->file_uploaded && Storage::disk('public')->exists($content->file_uploaded)) {
            $this->contentRepository->deleteFile($content->file_uploaded);
        }

        if ($request->hasFile('file_uploaded') && ($request->type === 'image' || $request->type === 'document')) {
            $filePath = $request->file('file_uploaded')->store('contents', 'public');
            $validatedData['file_uploaded'] = $filePath;
        }

        $this->contentRepository->update($content, $validatedData);

        return redirect()->back()->with('success', 'Content updated successfully.');
    }
}
