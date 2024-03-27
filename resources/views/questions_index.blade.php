<x-app-layout>
    <x-card title="Questions List" subtitle="Showing All Questions" shadow separator>
        <div class="flex justify-between items-center mb-2">
            <div>
                <a href="{{ route('questions.create',['module_id' => $module_id]) }}"
                   class="w-20 p-2 rounded-full flex items-center justify-center bg-green-500 text-white hover:bg-green-600">
                    <i class="fas fa-plus-circle"></i> &nbsp;New
                </a>
            </div>
            <form action="{{route('questions.index')}}" method="GET" class="flex">
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

        @if (session('success'))
            <x-div-message>
                {{ session('success') }}
            </x-div-message>
        @endif
        <div class="overflow-x-auto">


            <table class="min-w-full table-auto divide-y divide-gray-200 shadow-md">
                <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                        Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                        Type
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                        Alternatives
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6 text-center">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @if($questions->isEmpty())
                    <tr>
                        <td colspan="100%"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            No register was found with your search data.
                        </td>
                    </tr>
                @endif
                @foreach($questions as $question)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{$question->description}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{$question->type}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            @if($question->type == 'OBJECTIVE')
                                <a
                                    {{--                                href="{{ route('modules.index',['course_id' => $course->id]) }}"--}}
                                    class="text-white bg-green-500 hover:bg-green-600 border border-gray-300 p-2 rounded-full">
                                    <i class="fas fa-circle-arrow-right"></i>
                                    &nbsp;{{ count($question->alternatives) }}
                                </a>
                            @else
                                - not applicable -
                            @endif

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <x-edit-delete-actions :id="$question->id"
                                                   :route="__('questions')"
                                                   :singular="__('question')"/>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="mt-4">{{ $questions->links() }}</div>
        </div>


    </x-card>

</x-app-layout>



