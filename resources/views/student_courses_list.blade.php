{{--@php dd($courses_enrolled); @endphp--}}
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

        @if (session('enroll_success'))
            <x-div-message>
                {{ session('enroll_success') }}
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
                            {{--                            <livewire:modalconfirm-component type="professors" :data="$course"/>--}}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">

                            <form id="enrollmentForm" action="{{ route('courses.enroll_student', $course) }}"
                                  method="POST" style="display:none;">
                                @csrf
                            </form>

                            <div x-data="{ showModal: false }">
                                <button @click="showModal = true"
                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">
                                    <i class="fas fa-plus"></i> &nbsp;Enroll
                                </button>

                                <div x-show="showModal"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-90"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-300"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-90"
                                     class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center p-4 z-50">
                                    <div class="bg-white rounded-lg p-6 shadow-xl max-w-sm w-full">
                                        <h2 class="text-lg font-semibold">Confirm Action</h2>
                                        <p class="text-gray-700">Are you sure you want to enroll?</p>
                                        <div class="mt-4 flex justify-end space-x-3">
                                            <button @click="showModal = false"
                                                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                                Cancel
                                            </button>
                                            <button
                                                @click="showModal = false; document.getElementById('enrollmentForm').submit();"
                                                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                                Confirm
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="mt-4">{{ $courses->links() }}</div>
        </div>

    </x-card>

    <x-card title="Courses I'm enrolled" subtitle="" shadow separator class="mt-4">
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

        @if (session('disenroll_success'))
            <x-div-message>
                {{ session('disenroll_success') }}
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
                @if($courses_enrolled->isEmpty())
                    <tr>
                        <td colspan="100%"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            No courses found with your search data.
                        </td>
                    </tr>
                @endif
                @foreach($courses_enrolled as $course)
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
                            <form id="disenrollmentForm" action="{{ route('courses.disenroll_student', $course) }}"
                                  method="POST">
                                @csrf

                            </form>

                            <div x-data="{ showModal: false }">
                                <button @click="showModal = true"
                                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">
                                    <i class="fas fa-minus"></i> &nbsp;Disenroll
                                </button>

                                <div x-show="showModal"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-90"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-300"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-90"
                                     class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center p-4 z-50">
                                    <div class="bg-white rounded-lg p-6 shadow-xl max-w-sm w-full">
                                        <h2 class="text-lg font-semibold">Confirm Action</h2>
                                        <p class="text-gray-700">Are you sure you want to disenroll?</p>
                                        <div class="mt-4 flex justify-end space-x-3">
                                            <button @click="showModal = false"
                                                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                                Cancel
                                            </button>
                                            <button
                                                @click="showModal = false; document.getElementById('disenrollmentForm').submit();"
                                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                Confirm
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                       
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="mt-4">{{ $courses_enrolled->links() }}</div>
        </div>

    </x-card>

</x-app-layout>

