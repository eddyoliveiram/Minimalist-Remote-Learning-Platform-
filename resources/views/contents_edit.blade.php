<x-app-layout>
    <x-card title="Edit Content" shadow separator>
        <div x-data="{ tipoSelecionado: '{{ $content->type }}' }">
            <form method="POST"
                  action="{{ route('contents.update', ['content' => $content->id, 'module_id' => $module_id])}}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @csrf
                @if (session('success'))
                    <x-div-message>
                        {{ session('success') }}
                    </x-div-message>
                @endif
                @if ($errors->has('module_id'))
                    <div class="alert bg-red-200"
                         x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 3000)"
                         x-show="show">
                        @foreach ($errors->get('module_id') as $error)
                            {{$error }}
                        @endforeach
                    </div>
                @endif

                <div class="flex w-full space-x-4">
                    <div class="w-1/4">
                        <div>
                            <x-input-label for="position" :value="__('Position (optional)')"/>
                            <x-text-input id="position" class="block mt-1 w-full" type="number" name="position"
                                          :value="old('position')" value="{{$content->position}}"></x-text-input>
                            <x-input-error :messages="$errors->get('position')" class="mt-2"/>
                        </div>
                    </div>
                    <div class="w-1/4">
                        <div>
                            <x-input-label for="type" :value="__('Type')"/>
                            <select id="type" name="type"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    x-model="tipoSelecionado">
                                <option value="">- Select -</option>
                                <option value="image">Upload
                                    Image
                                </option>
                                <option value="document">Upload
                                    Document
                                </option>
                                <option value="article">Write an
                                    Article
                                </option>
                                <option value="video">Youtube Video
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2"/>
                        </div>
                    </div>
                </div>
                <div class="flex w-full space-x-4 mt-2">
                    <div class="w-1/4" x-show="tipoSelecionado === 'article'" style="display: none;">
                        <x-input-label for="text_typed" :value="__('Article')"/>
                        <x-text-area id="text_typed" class="block mt-1 w-full" type="text" name="text_typed">
                            {{ old('text_typed', $content->text_typed) }}
                        </x-text-area>
                        <x-input-error :messages="$errors->get('text_typed')" class="mt-2"/>
                    </div>

                </div>
                <div class="flex w-full space-x-4 mt-2">
                    <div class="w-1/4" x-show="tipoSelecionado === 'video'" style="display: none;">
                        <div>
                            <x-input-label for="video_url" :value="__('Youtube Video URL')"/>
                            <x-text-input id="video_url" class="block mt-1 w-full" type="text" name="video_url"
                                          value="{{ old('text_typed', $content->video_url) }}"></x-text-input>
                            <x-input-error :messages="$errors->get('video_url')" class="mt-2"/>
                        </div>
                    </div>
                </div>
                <div class="flex w-full space-x-4">
                    <div class="w-1/4" x-show="tipoSelecionado === 'image' || tipoSelecionado === 'document'"
                         style="display: none;">
                        <x-input-label for="file_uploaded" :value="__('File')"/>
                        <x-file-input id="file_uploaded" class="block mt-1 w-full" type="file"
                                      name="file_uploaded"></x-file-input>
                        <x-input-error :messages="$errors->get('file_uploaded')" class="mt-2"/>
                    </div>
                </div>

                <div class="flex w-full mt-4 space-x-2">
                    <x-button type="submit" class="bg-purple-700 text-white hover:bg-purple-900">
                        <i class="fas fa-save text-white"></i>&nbsp;Save
                    </x-button>
                    <x-button onclick="window.location='{{ route('contents.index',['module_id' => $module_id]) }}'">
                        <i class="fas fa-circle-arrow-left"></i>&nbsp;Back
                    </x-button>
                </div>
            </form>
        </div>
    </x-card>
</x-app-layout>
