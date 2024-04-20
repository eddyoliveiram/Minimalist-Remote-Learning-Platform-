<x-app-layout>
    <x-card title="Welcome, {{ Auth::user()->name }}!" subtitle="Your Learning Dashboard" shadow separator>
        <div class="mt-2 bg-white p-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold">Announcements</h2>
            <ul>
                <li>Here there could be some announcements.</li>
            </ul>
        </div>
    </x-card>
</x-app-layout>
