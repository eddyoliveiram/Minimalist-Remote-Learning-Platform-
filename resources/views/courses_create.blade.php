<x-app-layout>
    <x-card title="Create Course" shadow separator>
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
                        <x-input label="Name" placeholder="Your name" icon="o-user" name="name"
                                 value="{{old('name')}}"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input label="Duration" placeholder="Duration" icon="o-clock" type="number" name="duration"
                                 value="{{old('duration')}}"/>
                        <x-input-error :messages="$errors->get('duration')" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="flex w-full mt-4 space-x-4">
                <div class="w-1/4">
                    <div>
                        <x-datetime label="Start Date" wire:model="myDate" icon="o-calendar" name="start_date"
                                    :value="old('start_date')" required/>
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-datetime label="End Date" wire:model="myDate" icon="o-calendar" name="end_date"
                                    :value="old('end_date')" required/>
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2"/>
                    </div>
                </div>
            </div>

            @php
                $statusOptions = [
                    ['id' => null, 'name' => '- Select -'],
                    ['id' => 1, 'name' => 'Editing'],
                    ['id' => 2, 'name' => 'Ready'],
                    ['id' => 3, 'name' => 'Finished']
                ];
            @endphp

            <div class="flex w-full mt-4 space-x-4">
                <div class="w-1/4">
                    <div>
                        <x-select label="Master user" :options="$statusOptions"
                                  wire:model="selectedUser"
                                  name="status_id" :value="old('status_id')"/>
                        <x-input-error :messages="$errors->get('status_id')" class="mt-2"/>
                    </div>
                </div>
                <div class="w-1/4">
                    <div>
                        <x-input label="Vacancies" placeholder="Vacancies" icon="o-users" type="number"
                                 name="vacancies"
                                 value="{{old('vacancies')}}" required/>
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
                                <x-checkbox label="{{$area->description}}" wire:model="item1" name="areas[]"
                                            value="{{Str::snake($area->id)}}"/>

                                {{--                                <label for="{{Str::snake($area->description)}}" class="inline-flex items-center">--}}
                                {{--                                    <input id="{{Str::snake($area->description)}}" value="{{Str::snake($area->id)}}"--}}
                                {{--                                           name="areas[]" type="checkbox"--}}
                                {{--                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">--}}
                                {{--                                    <span class="ms-2 text-sm text-purple-900">{{$area->description}}</span>--}}
                                {{--                                </label>--}}
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
    </x-card>
</x-app-layout>
