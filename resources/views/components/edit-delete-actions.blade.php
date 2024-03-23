@props(['id','route','singular'])

<div x-data="{ isOpen: false }" class="mt-3">

    <a href="{{ route($route . '.edit', [$singular => $id]) }}" class="btn-sm">
        <x-button icon="fas.edit" wire:click="" spinner class="btn-sm"/>
    </a>
    <x-button icon="fas.trash" spinner class="btn-sm" @click="isOpen = true"/>

    {{--    <a href="{{ route($route.'.edit', [$singular => $id]) }}"--}}
    {{--       class="text-gray-600 hover:bg-gray-100 border border-gray-300 p-2 mr-2 rounded-xl">Edit</a>--}}

    {{--    <button @click="isOpen = true" class="text-gray-600 hover:bg-gray-100 border border-gray-300 rounded-xl p-2">--}}
    {{--        Delete--}}
    {{--    </button>--}}

    <div x-show="isOpen" @click.away="isOpen = false"
         class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50" style="display: none;">
        <div class="bg-white rounded-lg p-8">
            <h2 class="text-xl font-bold mb-4">Are you sure you want to delete this item?</h2>
            <p></p>
            <div class="mt-6 flex justify-end">
                <button @click="isOpen = false" class="text-gray-600 hover:text-gray-800 mr-4">Cancel</button>
                <form action="{{ route($route.'.destroy', [$singular => $id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
