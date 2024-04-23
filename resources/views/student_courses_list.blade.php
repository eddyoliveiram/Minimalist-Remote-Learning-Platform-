<x-app-layout>
    @if(session('error'))

        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 3000)"
             x-show="show"
             class="bg-red-500 p-4 rounded-xl text-white mb-2">
            {{ session('error') }}
        </div>
    @endif

    <x-card title="Courses List" subtitle="" shadow separator>
        <div class="flex justify-between items-center mb-2 gap-4">
            <div>

            </div>
            <form action="{{route('student.courses-list')}}" method="GET" class="flex">
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
                        Course
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                        Duration
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4 text-center">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4 text-center">
                        Professors
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6 text-center">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @if($courses->isEmpty())
                    <tr>
                        <td colspan="100%"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            No courses found with your search data.
                        </td>
                    </tr>
                @endif
                @foreach($courses as $course)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{$course->name}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{$course->duration}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{$course->status_id}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{--                            <x-modal-list-people :title="__('Professors')" :array="$course->professors"/>--}}
                            <livewire:modal-component type="professors" :data="$course"/>

                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <form action="{{ route('courses.enroll_student', $course) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-30 px-2 py-2 rounded-full flex items-center justify-center bg-green-500 text-white hover:bg-green-600">
                                    <i class="fas fa-plus-circle"></i> &nbsp;Enroll
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="mt-4">{{ $courses->links() }}</div>
        </div>

    </x-card>

</x-app-layout>

