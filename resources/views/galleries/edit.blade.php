<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Gallery') }}
            </h2>
            <div>
                <a href="{{ route('galleries.index') }}" class="">Back Event</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('galleries.update', $gallery) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        {{-- caption --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="caption" class="block g-md-2 text-sm font-medium">Caption</label>
                            <input type="text" id="caption" name="caption"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                                placeholder="Event caption" value="{{ old('caption', $gallery->caption) }}">
                            @error('caption')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- image --}}

                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="image" class="text-sm font-medium">Upload Image</label>
                            <input type="file" id="image" name="image">
                            @error('image')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Show the old image below the input if it exists --}}
                        <div class="mt-4  mb-6">
                            <p class="text-sm text-gray-500">Current Image:</p>
                            <img src="{{ !empty($gallery->image) && Storage::disk('public')->exists($gallery->image)
                                ? asset('storage/' . $gallery->image)
                                : 'https://placehold.co/600x400' }}"
                                alt="Event Image" class="w-20 h-20 object-cover mt-2 rounded-lg shadow-md">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white mt-4 px-4 py-2 rounded">Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
