@if($showModal)
    <x-modal class="backdrop-blur" x-on:keydown.escape.window="closeModal" x-on:click.outside="closeModal">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900 bg-gray-200 p-2">Are you sure you want to
                enroll?</h3>
            <div class="mt-2 flex justify-center space-x-4">
                <x-button wire:click="confirmEnrollment"
                          class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Yes
                </x-button>
                <x-button wire:click="closeModal"
                          class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">No
                </x-button>
            </div>
        </div>
    </x-modal>
@endif
