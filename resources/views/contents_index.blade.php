<x-app-layout>
    <x-div-content>
        <span class="text-4xl">{{$module->name}}</span>
    </x-div-content>
    <x-div-content>
        @if (session('success'))
            <x-div-message>
                {{ session('success') }}
            </x-div-message>
        @endif
        <div class="overflow-x-auto">
            <div class="flex justify-between items-center mb-2">
                <div>
                    <a href="{{ route('contents.create', ['module_id' => $module->id]) }}"
                       class="w-20 p-2 rounded-full flex items-center justify-center bg-green-500 text-white hover:bg-green-600">
                        <i class="fas fa-plus-circle"></i> &nbsp;New
                    </a>
                </div>
                <form action="{{route('contents.index', ['module_id' => $module->id])}}" method="GET" class="flex">
                    @foreach(request()->except('search') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input type="text" name="search" placeholder="Any column..."
                           class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-300 bg-white">
                    <button type="submit"
                            class="px-4 rounded-r-lg bg-gray-100 text-gray-600 border-gray-300 hover:bg-gray-200 border-t border-b border-r">
                        Search
                    </button>
                </form>
            </div>

            <table class="min-w-full table-auto divide-y divide-gray-200 shadow-md">
                <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                        Position
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                        Type
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                        Content
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($contents as $c => $content)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{$content->position.'º'}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ucfirst($content->type)}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            @if($content->type === 'image')
                                <a href="{{ asset('storage/' . $content->file_uploaded) }}" target="_blank"
                                   style="display: inline-block;">
                                    <img src="{{ asset('storage/' . $content->file_uploaded) }}" alt="content image"
                                         style="width: 320px; max-height: 240px">
                                </a>
                            @elseif($content->type === 'document')
                                <a href="{{ asset('storage/' . $content->file_uploaded) }}" download
                                   class="text-blue-500">
                                    <i class="fas fa-download"></i> Document [Download]</a>
                            @elseif($content->type === 'video')
                                @php
                                    parse_str(parse_url($content->video_url, PHP_URL_QUERY), $youtubeQuery);
                                    $videoId = $youtubeQuery['v'] ?? null;
                                @endphp

                                @if($videoId)
                                    <iframe width="320" height="240" src="https://www.youtube.com/embed/{{ $videoId }}"
                                            frameborder="0" allow="autoplay; encrypted-media; fullscreen"
                                            allowfullscreen></iframe>
                                @else
                                    <p>Invalid YouTube link</p>
                                @endif

                            @else
                                <!-- Just display the content data as text -->
                                {{ $content->text_typed }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <x-edit-delete-actions :id="$content->id" :route="__('contents')"
                                                   :singular="__('content')"/>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            No modules found with your search data.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{--            <div class="mt-4">{{ $modules->links() }}</div>--}}
            <div class="flex w-full mt-4 space-x-4">
                <x-secondary-button
                    onclick="window.location.href='{{ route('modules.index',['course_id' => $module->course_id]) }}'">
                    <i class="fas fa-circle-arrow-left"></i>&nbsp;Back
                </x-secondary-button>
            </div>
        </div>
    </x-div-content>

</x-app-layout>




