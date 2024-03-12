@props(['array','title'])

<div x-data="{ open: false }">
    <span @click="open = true" class="cursor-pointer">
        {{ count($array) }} <i class="fas fa-eye"></i>
    </span>

    <div
        x-show="open"
        @click.away="open = false"
        style="display: none;"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
        x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-300 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div
            class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white overflow-y-auto max-h-[calc(100vh-100px)]"
            @click.away="open = false"
        >
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 bg-gray-200 p-2">{{$title.' list'}}</h3>
                <div class="mt-2">
                    <ul>
                        @forelse ($array as $a)
                            <li>{{ $a->name }}</li>
                        @empty
                            <li>- Nobody so far -</li>
                        @endforelse
                    </ul>
                </div>
                <div class="mt-5">
                    <button @click="open = false" class="px-4 py-2 bg-gray-500 text-white rounded">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
