<?php

namespace App\Repositories;

use App\Models\Content;
use App\Services\Interfaces\ContentRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ContentRepository implements ContentRepositoryInterface
{
    public function update(Content $content, array $data): Content
    {
        $content->update($data);
        return $content;
    }

    public function deleteFile(string $filePath): void
    {
        Storage::disk('public')->delete($filePath);
    }
}
