<div>
    <x-button wire:click="$set('myModal1', true)">
        <i class='fas fa-eye'></i>
        {{count($data)}}
    </x-button>
    @if($myModal1)
        <x-modal class="backdrop-blur"
                 x-on:keydown.escape.window="closeModal"
                 x-on:click.outside="closeModal">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 bg-gray-200 p-2">{{' list'}}</h3>
                <div class="mt-2">
                    <ul>
                        @forelse ($data as $p)
                            <li>{{ ($p->user->name) ?? $p->name }}</li>
                        @empty
                            <li>- Nobody so far -</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{--            <div class="mb-5 text-xs">Press `ESC`, click outside or click `CANCEL` to close.</div>--}}
            <x-button class="mt-4" label="Close" wire:click="closeModal"/>
        </x-modal>
    @endif
</div>
