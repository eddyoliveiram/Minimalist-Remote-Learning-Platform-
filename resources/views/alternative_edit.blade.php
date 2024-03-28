<x-app-layout>
    <x-card title="Edit Alternative" shadow separator>
        <form method="POST" action="{{ route('alternatives.update',["alternative" => $alternative->id]) }}"
              enctype="multipart/form-data">
            <input type="hidden" value="{{$alternative->question_id}}" name="question_id">
            @csrf
            @method('PUT')
            @if (session('success'))
                <x-div-message>
                    {{ session('success') }}
                </x-div-message>
            @endif
            <div class="flex w-full space-x-4">
                <div class="w-1/4">
                    <div>
                        <x-input label="Description" placeholder="Description" name="description"
                                 value="{{$alternative->description}}"/>
                    </div>
                </div>
            </div>
            <div class="flex w-full space-x-4">
                <div class="w-1/4 mt-2">
                    <input type="checkbox" id="right_one_{{ $alternative->id }}" class="mt-2"
                           wire:model="item1" name="right_one[]"
                           value="{{ $alternative->id }}"
                        {{ $alternative->right_one ? 'checked' : '' }}/>
                    <label for="right_one_{{ $alternative->id }}">That's the correct one</label>
                </div>
            </div>

            @if($errors->any())
                <div class="error">
                    @foreach($errors->all() as $message)
                        <x-input-error :messages="$message" class="mt-2"/>
                    @endforeach
                </div>
            @endif


            <div class="flex w-full mt-4 space-x-4">
                <x-button type="submit" class="bg-purple-700 text-white hover:bg-purple-900">
                    <i class="fas fa-save text-white"></i>&nbsp;Save
                </x-button>
                <x-button
                    onclick="window.location='{{ route('alternatives.index',['question_id' => $alternative->question_id]) }}'">
                    <i class="fas fa-circle-arrow-left"></i>&nbsp;Back
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
