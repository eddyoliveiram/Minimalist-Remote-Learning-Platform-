<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreContentRequest;
use App\Models\Content;
use Illuminate\Http\RedirectResponse;

interface ContentServiceInterface
{
    public function updateContent(StoreContentRequest $request, Content $content): RedirectResponse;
}
