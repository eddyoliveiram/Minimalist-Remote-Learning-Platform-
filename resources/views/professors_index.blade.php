<x-app-layout>
    <x-div-content>
        <div class="flex justify-between items-center mb-2">
            <div>
                <a href="{{ route('professors.create') }}"
                   class="text-white bg-green-500 hover:bg-green-600 border p-2 rounded-lg">
                    New Professor
                </a>
            </div>
            <form action="{{route('professors.index')}}" method="GET" class="flex">
                <input type="text" name="search" placeholder="Any column..."
                       class="rounded-l-lg p-2 border-t mr-0 border-b border-l text-gray-800 border-gray-300 bg-white">
                <button type="submit"
                        class="px-4 rounded-r-lg bg-gray-100 text-gray-600 border-gray-300 hover:bg-gray-200 border-t border-b border-r">
                    Search
                </button>
            </form>
        </div>

        @if (session('success'))
            <x-div-message>
                {{ session('success') }}
            </x-div-message>
        @endif
        <div class="overflow-x-auto">


            <table class="min-w-full table-auto divide-y divide-gray-200 shadow-md">
                <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                        Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                        Registation
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6 text-center">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @if($professors->isEmpty())
                    <tr>
                        <td colspan="100%"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            No professors found with your search data.
                        </td>
                    </tr>
                @endif
                @foreach($professors as $professor)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{$professor->name}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{$professor->registration}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <x-edit-delete-actions :id="$professor->id"
                                                   :route="__('professors')"
                                                   :singular="__('professor')"/>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="mt-4">{{ $professors->links() }}</div>
        </div>


    </x-div-content>

</x-app-layout>



