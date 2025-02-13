<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Galleries') }}
            </h2>
            <div>
                <a href="{{ route('galleries.create') }}" class="">New Gallery</a>
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
                                    <th scope="col" class="px-6 py-3">Caption</th>
                                    <th scope="col" class="px-6 py-3">Image</th>
                                    <th scope="col" class="px-6 py-3">Created At</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($galleries as $gallery)
                                    <tr class="bg-white border-b border-gray-300">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $gallery->caption }}
                                        </th>
                                        <td lass="px-6 py-4">
                                            <img src="{{ !empty($gallery->image) && Storage::disk('public')->exists($gallery->image)
                                                ? asset('storage/' . $gallery->image)
                                                : 'https://placehold.co/600x400' }}"
                                                alt="Event Image"
                                                class="w-20 h-20 object-cover mt-2 rounded-lg shadow-md">
                                        </td>

                                        <td class="px-6 py-4">{{ $gallery->created_at->format('F j, Y') }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2 gap-2">
                                                <!-- Edit Button -->
                                                <a href="{{ route('galleries.edit', $gallery) }}"
                                                    class="px-3 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-sm">
                                                    Edit
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('galleries.destroy', $gallery) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm"
                                                        onclick="return confirm('Are you sure you want to delete the event with Caption: {{ $gallery->caption }}?') ? this.closest('form').submit() : null;">
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
                            {{ $galleries->links() }}
                        </div>




                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
