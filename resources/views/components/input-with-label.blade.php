@props([
    'name',
    'type' => 'text'
])
@php
    $snake = Str::snake($name);
@endphp

<x-input-label for="{{$snake}}" :value="__(ucfirst($name))" />
    <x-text-input id="{{$snake}}"  class="block mt-1 w-full" type="{{$type}}" name="{{$snake}}" :value="old($snake)" />
<x-input-error :messages="$errors->get($snake)" class="mt-2" />
