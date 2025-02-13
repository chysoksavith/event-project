<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Events') }}
            </h2>
            <div>
                <a href="{{ route('eventss.create') }}" class="">New Event</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2">
                    @include('_message')

                </div>
                <div class="p-6 text-gray-900">


                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-900 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Title</th>
                                    <th scope="col" class="px-6 py-3">Start Date</th>
                                    <th scope="col" class="px-6 py-3">Country</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($events as $event)
                                    <tr class="bg-white border-b border-gray-300">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $event->title }}
                                        </th>
                                        <td class="px-6 py-4"> {{ $event->start_date }}</td>
                                        <td class="px-6 py-4">{{ $event->country->name }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2 gap-2">
                                                <!-- Edit Button -->
                                                <a href="{{ route('eventss.edit', $event) }}"
                                                    class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-sm">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('eventss.destroy', $event) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm"
                                                        onclick="return confirm('Are you sure you want to delete the event with Title: {{ $event->title }}?') ? this.closest('form').submit() : null;">
                                                        Delete </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center">No Data</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="flex  mt-4">
                            {{ $events->links() }}
                        </div>




                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
