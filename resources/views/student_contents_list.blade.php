<x-app-layout>
    <x-card>
        <div class="flex items-center gap-2 mt-2">
            @if($course->image)
                <img src="{{ asset('storage/' . $course->image) }}" class="rounded-full h-16 w-16">
            @else
                <div class="rounded-full h-16 w-16 flex items-center justify-center bg-gray-200 text-gray-700">
                    [IMG]
                </div>
            @endif
            <div class="text-4xl">{{$course->name}}</div>
        </div>
    </x-card>
    <div class="rounded overflow-hidden shadow-lg mt-4">
        <div class="text-gray-500 italic bg-gray-200 p-4">
            Module
        </div>
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ $module->name }}</div>
            <p class="text-gray-700 text-base">
                {{ $module->description }}
            </p>
        </div>
        <div class="px-6 pb-2 mb-4">
            <table class="min-w-full table-auto divide-y divide-gray-200 shadow-md">
                <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                        Content
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($contents as $c => $content)
                    <tr>

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

                    </tr>
                @empty
                    <tr>
                        <td colspan="100%"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            No contents so far.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="flex w-full mt-4 space-x-4">
                <button onclick="history.back()"
                        class="transition duration-300 bg-gray-100 p-4 px-5 font-semibold text-gray-700 rounded-md text-sm
                    hover:bg-gray-200">
                    <i class=" fas fa-circle-arrow-left"></i> Back
                </button>
            </div>
        </div>
    </div>


</x-app-layout>




