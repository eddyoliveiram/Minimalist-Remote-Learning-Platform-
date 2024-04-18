<x-app-layout>
    <x-card title="New Professor" shadow separator>
        <form method="POST" action="{{ route('professors.store') }}" enctype="multipart/form-data">
            @csrf
            @if (session('success'))
                <x-div-message>
                    {{ session('success') }}
                </x-div-message>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-5 rounded shadow-md"
                     x-data="{ show: true }"
                     x-init="setTimeout(() => show = false, 3000)"
                     x-show="show">
                    @foreach($errors->all() as $message)
                        <x-input-error :messages="$message" class="mt-2"/>
                    @endforeach
                </div>
            @endif

            <div class="flex w-full space-x-4">
                <div class="w-1/4">
                    <div>
                        <x-input label="Name" placeholder="Your name" icon="o-user" name="name"
                                 value="{{old('name')}}"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input label="Email" placeholder="Your email" name="email" type="email"
                                 value="{{old('email')}}"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input label="Password" placeholder="Password" name="password" type="password"
                                 value="{{old('password')}}"/>
                    </div>
                </div>
            </div>

            <div class="flex w-full mt-4 space-x-4">
                <x-button type="submit" class="bg-purple-700 text-white hover:bg-purple-900">
                    <i class="fas fa-save text-white"></i>&nbsp;Save
                </x-button>
                <x-button onclick="window.location='{{ route('professors.index') }}'">
                    <i class=" fas fa-circle-arrow-left"></i>&nbsp;Back
                </x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
