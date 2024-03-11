<div x-data="{ show: true }"
     x-init="setTimeout(() => show = false, 3000)"
     x-show="show"
     x-transition:enter="transition ease-out duration-900"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
    {{ $attributes->merge(['class' => 'bg-green-200 p-2 mb-2 rounded text-center']) }}>
    {{$slot}}
</div>
