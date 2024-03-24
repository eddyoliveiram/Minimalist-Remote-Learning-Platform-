<?php

namespace App\Services\Interfaces;

use App\Models\Content;

interface ContentRepositoryInterface
{
    public function update(Content $content, array $data): Content;

    public function deleteFile(string $filePath): void;
}
