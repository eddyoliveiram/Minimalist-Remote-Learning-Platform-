<x-app-layout>
    <x-card title="Edit Course" shadow separator>
        <form method="POST" action="{{ route('courses.update', ['course' => $course->id])}}"
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
                                      value="{{ $course['name'] }}"></x-text-input>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input-label for="duration" :value="__('Duration (hours)')"/>
                        <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration"
                                      value="{{ $course['duration'] }}"></x-text-input>
                        <x-input-error :messages="$errors->get('duration')" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="flex w-full mt-4 space-x-4">
                <div class="w-1/4">
                    <div>
                        <x-input-label for="start_date" :value="__('Start Date')"/>
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                                      value="{{ $course['start_date'] }}" required></x-text-input>
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input-label for="end_date" :value="__('End Date')"/>
                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                                      value="{{ $course['end_date'] }}" required></x-text-input>
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
                            @foreach($statuses as $status)
                                <option
                                    value="{{$status->id}}" {{ $course['status_id'] == $status->id ? 'selected' : '' }}>
                                    {{$status->description}}
                                </option>
                            @endforeach

                        </select>
                        <x-input-error :messages="$errors->get('status_id')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input-label for="vacancies" :value="__('Vacancies')"/>
                        <x-text-input id="vacancies" class="block mt-1 w-full" type="number" name="vacancies"
                                      value="{{ $course['vacancies'] }}" required></x-text-input>
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
            </div>
            <div class="flex w-full mt-4 space-x-4">
                <div class="w-1/4">
                    <x-input-label for="image" :value="__('Knowledge Areas')"/>
                    <ul class="mt-2">
                        @foreach($knowledge_areas as $area)
                            <li>
                                <label for="area_{{ $area->id }}" class="inline-flex items-center">
                                    <input id="area_{{ $area->id }}" value="{{ $area->id }}" name="areas[]"
                                           type="checkbox"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                           @if($course->knowledgeAreas->contains($area->id))
                                               checked
                                        @endif>
                                    <span class="ml-2 text-sm text-gray-600">{{ $area->description }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-1/4">
                    <x-input-label for="image" :value="__('Professors')"/>
                    <ul class="mt-2">
                        @foreach($professors as $professor)
                            <li>
                                <label for="professor_{{ $professor->id }}" class="inline-flex items-center">
                                    <input id="professor_{{ $professor->id }}" value="{{ $professor->id }}"
                                           name="professors[]"
                                           type="checkbox"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                           @if($course->professors->contains($professor->id))
                                               checked
                                        @endif>
                                    <span class="ml-2 text-sm text-gray-600">{{ $professor->user->name }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>


            <div class="flex w-full mt-4 space-x-2">
                <x-button type="submit" class="bg-purple-700 text-white hover:bg-purple-900">
                    <i class="fas fa-save text-white"></i>Save
                </x-button>
                <x-button onclick="history.back()">
                    <i class=" fas fa-circle-arrow-left"></i>Back
                </x-button>
            </div>


        </form>
    </x-card>


</x-app-layout>
