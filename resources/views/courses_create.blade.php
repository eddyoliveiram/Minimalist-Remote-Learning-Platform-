<x-app-layout>

    <x-div-content>
        <span class="text-gray-700 italic">Create Course</span>
        <hr class="mb-6 mt-2">
        <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
            @csrf
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
                                      :value="old('name')"></x-text-input>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input-label for="duration" :value="__('Duration (hours)')"/>
                        <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration"
                                      :value="old('duration')"></x-text-input>
                        <x-input-error :messages="$errors->get('duration')" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="flex w-full mt-4 space-x-4">
                <div class="w-1/4">
                    <div>
                        <x-input-label for="start_date" :value="__('Start Date')"/>
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                                      :value="old('start_date')" required></x-text-input>
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input-label for="end_date" :value="__('End Date')"/>
                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                                      :value="old('end_date')" required></x-text-input>
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="flex w-full mt-4 space-x-4">
                <div class="w-1/4">
                    <div>
                        <x-input-label for="status_id" :value="__('Status')"/>
                        <select id="status_id" name="status_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="">- Select -</option>
                            <option value="1" {{ old('status_id') == "1" ? 'selected' : '' }}>Editing</option>
                            <option value="2" {{ old('status_id') == "2" ? 'selected' : '' }}>Ready</option>
                            <option value="3" {{ old('status_id') == "3" ? 'selected' : '' }}>Finished</option>
                        </select>
                        <x-input-error :messages="$errors->get('status_id')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input-label for="vacancies" :value="__('Vacancies')"/>
                        <x-text-input id="vacancies" class="block mt-1 w-full" type="number" name="vacancies"
                                      :value="old('vacancies')" required></x-text-input>
                        <x-input-error :messages="$errors->get('vacancies')" class="mt-2"/>
                    </div>
                </div>
            </div>
            <div class="flex w-full mt-4 space-x-4">
                <div class="w-1/4">
                    <x-input-label for="image" :value="__('Image')"/>
                    <x-file-input id="image" class="block mt-1 w-full" type="number" name="image"
                                  :value="old('image')"></x-file-input>
                    <x-input-error :messages="$errors->get('image')" class="mt-2"/>

                </div>
                <div class="w-1/4">
                    <x-input-label for="image" :value="__('Knowledge Areas')"/>
                    <ul class="mt-2">
                        @foreach($knowledge_areas as $area)
                            <li>
                                <label for="{{Str::snake($area->description)}}" class="inline-flex items-center">
                                    <input id="{{Str::snake($area->description)}}" value="{{Str::snake($area->id)}}"
                                           name="areas[]" type="checkbox"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ms-2 text-sm text-purple-900">{{$area->description}}</span>
                                </label>
                            </li>
                    @endforeach
                </div>
            </div>
            </ul>
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
