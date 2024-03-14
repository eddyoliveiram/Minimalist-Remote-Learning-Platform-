<x-app-layout>

    <x-div-content>
        <span class="text-gray-700 italic">Edit Student</span>
        <hr class="mb-6 mt-2">
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

            <div class="flex w-full mt-4 space-x-4">
                <x-primary-button>
                    <i class="fas fa-save"></i>&nbsp;Save
                </x-primary-button>
                <x-secondary-button onclick="history.back()">
                    <i class="fas fa-circle-arrow-left"></i>&nbsp;Back
                </x-secondary-button>
            </div>
        </form>
    </x-div-content>
</x-app-layout>
