<div class="mt-2 ml-8">
    <nav aria-label="breadcrumb" class="flex">
        <ol class="flex items-center space-x-2">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="flex items-center">
                    @if (!$loop->last)
                        <a href="{{ $breadcrumb['url'] }}" class="text-blue-500 hover:text-blue-800">{{ $breadcrumb['title'] }}</a>
                        <span class="ml-2 text-gray-600">/</span>
                    @else
                        <span class="text-gray-500">{{ $breadcrumb['title'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
</div>

