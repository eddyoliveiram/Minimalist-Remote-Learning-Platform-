<x-app-layout>
    <x-card title="New Question" shadow separator>
        <form method="POST" action="{{ route('questions.store') }}" enctype="multipart/form-data">
            <input type="hidden" value="{{$module_id}}" name="module_id">
            @csrf
            @if (session('success'))
                <x-div-message>
                    {{ session('success') }}
                </x-div-message>
            @endif
            {{--            @if($errors->get('type'))--}}
            {{--                @foreach($errors->get('type') as $message)--}}
            {{--                    <div class="mt-2 text-red-500">{{ $message }}</div>--}}
            {{--                @endforeach--}}
            {{--            @endif--}}

            <div class="flex w-full space-x-4">
                <div class="w-1/4">
                    <div>
                        <x-input label="Description" placeholder="Description" name="description"
                                 value="{{old('description')}}"/>
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>
                </div>
                @php
                    $types = [
                            [
                                'id' => null,
                                'name' => '- SELECT -'
                            ],
                            [
                                'id' => 'OBJECTIVE',
                                'name' => 'OBJECTIVE'
                            ],
                            [
                                'id' => 'SUBJECTIVE',
                                'name' => 'SUBJECTIVE'
                            ]
                        ];
                @endphp

                <div class="w-1/4">
                    <x-select id="type" name="type" :options="$types" label="Type" wire:model=""/>
                    <x-input-error :messages="$errors->get('type')" class="mt-2"/>
                </div>
            </div>

            <div class="flex w-full mt-4 space-x-4">
                <x-button type="submit" class="bg-purple-700 text-white hover:bg-purple-900">
                    <i class="fas fa-save text-white"></i>&nbsp;Save
                </x-button>
                <x-button onclick="history.back()">
                    <i class=" fas fa-circle-arrow-left"></i>&nbsp;Back
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
