<x-app-layout>

    <x-card title="Edit Student" shadow separator>
        <form method="POST" action="{{ route('students.update',['student' => $student->id]) }}"
              enctype="multipart/form-data">
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
                        <x-input-label for="name" :value="__('Name')"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                      :value="$student->name"></x-text-input>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input-label for="registration" :value="__('Registration')"/>
                        <x-text-input id="registration" class="block mt-1 w-full" type="text" name="registration"
                                      :value="$student->registration"></x-text-input>
                        <x-input-error :messages="$errors->get('registration')" class="mt-2"/>
                    </div>
                </div>
            </div>
            <div class="flex w-full space-x-4 mt-2">
                <div class="w-1/4">
                    <div>
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="email"
                                      :value="$student->email"></x-text-input>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input-label for="phone" :value="__('Phone')"/>
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                      :value="$student->phone"></x-text-input>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="flex w-full mt-4 space-x-2">
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
