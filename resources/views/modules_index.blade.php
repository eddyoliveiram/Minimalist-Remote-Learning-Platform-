<x-app-layout>
    <x-card>
        <div class="text-sm">Course</div>
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


    <x-card class="mt-2">
        @if (session('success'))
            <x-div-message>
                {{ session('success') }}
            </x-div-message>
        @endif
        <div class="overflow-x-auto">
            <div class="flex justify-between items-center mb-2">
                <div>
                    <a href="{{ route('modules.create', ['course_id' => $course->id]) }}"
                       class="w-20 p-2 rounded-full flex items-center justify-center bg-green-500 text-white hover:bg-green-600">
                        <i class="fas fa-plus-circle"></i> &nbsp;New
                    </a>
                </div>
                <form action="{{route('modules.index', ['course_id' => $course->id])}}" method="GET" class="flex">
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
                        Module
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                        Contents
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                        Questions
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @if($modules->isEmpty())
                    <tr>
                        <td colspan="100%"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            No modules found with your search data.
                        </td>
                    </tr>
                @endif
                @foreach($modules as $module)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{$module->name}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <a href="{{ route('contents.index',['module_id' => $module->id]) }}"
                               class="text-white bg-green-500 hover:bg-green-600 border border-gray-300 p-2 rounded-full">
                                <i class="fas fa-circle-arrow-right"></i>
                                &nbsp;{{ count($module->contents) }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{'-'}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <x-edit-delete-actions :id="$module->id" :route="__('modules')" :singular="__('module')"/>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="mt-4">{{ $modules->links() }}</div>
            <div class="flex w-full mt-4 space-x-4">

                <button onclick="history.back()"
                        class="transition duration-300 bg-gray-100 p-4 px-5 font-semibold text-gray-700 rounded-md text-sm
                    hover:bg-gray-200">
                    <i class=" fas fa-circle-arrow-left"></i> Back
                </button>
            </div>
        </div>
    </x-card>

</x-app-layout>




