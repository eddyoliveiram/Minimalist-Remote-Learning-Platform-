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
        <div class="bg-gray-200 p-4">
            <div class="text-gray-500 italic text-sm">Module</div>
            <div class="font-bold text-xl mb-2">{{ $module->name }}</div>
        </div>

        <div class="px-6 pb-2 mb-4 bg-gray-100">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Contents</div>
            </div>
            {{ $module->description }}
            @forelse($contents as $c => $content)
                <x-card class="mb-4">
                    <div class="p-4 text-center">
                        @switch($content->type)
                            @case('image')
                                <a href="{{ asset('storage/' . $content->file_uploaded) }}" target="_blank"
                                   style="display: inline-block;">
                                    <img src="{{ asset('storage/' . $content->file_uploaded) }}" alt="content image"
                                         style="width: 320px; max-height: 240px">
                                </a>
                                @break

                            @case('document')
                                <a href="{{ asset('storage/' . $content->file_uploaded) }}" download
                                   class="text-blue-500">
                                    <i class="fas fa-download"></i> Document [Download]
                                </a>
                                @break

                            @case('video')
                                @php
                                    parse_str(parse_url($content->video_url, PHP_URL_QUERY), $youtubeQuery);
                                    $videoId = $youtubeQuery['v'] ?? null;
                                @endphp

                                @if($videoId)
                                    <div class="flex justify-center">
                                        <iframe class="w-80 h-60" src="https://www.youtube.com/embed/{{ $videoId }}"
                                                frameborder="0"
                                                allow="autoplay; encrypted-media; fullscreen"
                                                allowfullscreen>
                                        </iframe>
                                    </div>

                                @else
                                    <p>Invalid YouTube link</p>
                                @endif
                                @break

                            @default
                                <p>{{ $content->text_typed }}</p>
                        @endswitch
                    </div>
                </x-card>
            @empty
                <div class="p-4 text-center text-sm font-medium text-gray-900">
                    No contents so far.
                </div>
            @endforelse

            <hr>
            <div class="font-bold text-xl mb-2 mt-2">Questions</div>

            @foreach ($questions as $question)
                <div class="question">
                    <p class="mt-4 mb-4"> {{ $question->description }}</p>
                    <x-card class="mb-4">
                        <div class="p-4 text-center">
                            <form action="" method="POST" class="flex flex-col items-start">
                                @csrf
                                @if ($question->type === 'OBJECTIVE')
                                    <ul>
                                        @foreach ($question->alternatives as $option)
                                            <li class="ml-0">
                                                <label class="flex items-center space-x-2">
                                                    <input type="radio" name="answer[{{ $question->id }}]"
                                                           value="{{ $option->id }}">
                                                    <span>{{ $option->description }}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif ($question->type === 'SUBJECTIVE')
                                    <textarea name="answer[{{ $question->id }}]" rows="4" cols="50"
                                              class="w-full mt-2"
                                              placeholder=""></textarea>
                                @endif

                                <div class="mt-4 self-end"> <!-- Self-align to the end/right -->
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </x-card>
                </div>
            @endforeach


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




