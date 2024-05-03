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

    <div class="grid grid-cols-1 xs:grid-cols-3 gap-4 p-4">

        @foreach($modules as $c => $module)
            <div class="rounded overflow-hidden shadow-lg ">
                <div class="text-gray-500 italic bg-gray-200 p-4">
                    Module {{ str_pad($c + 1, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $module->name }}</div>
                    <p class="text-gray-700 text-base">
                        {{ $module->description }}
                    </p>
                </div>
                <div class="px-6 pb-2 mb-4">
                    <a href="{{ route('student.modules.show-contents',['module' => $module->id]) }}"
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ">
                        <i class="fas fa-circle-arrow-right"></i> Open
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex w-full mt-4 space-x-4 ">
        <button onclick="history.back()"
                class="transition duration-300 bg-gray-100 p-4 px-5 font-semibold text-gray-700 rounded-md text-sm
                    hover:bg-gray-200">
            <i class=" fas fa-circle-arrow-left"></i> Back
        </button>
    </div>

</x-app-layout>




