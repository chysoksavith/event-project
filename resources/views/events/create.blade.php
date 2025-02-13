<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New Event') }}
            </h2>
            <div>
                <a href="{{ route('eventss.index') }}" class="">Back Event</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('eventss.store') }}" enctype="multipart/form-data"
                        class="p-4 rounded-md">
                        @csrf
                        {{-- title --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="title" class="block g-md-2 text-sm font-medium">Title</label>
                            <input type="text" id="title" name="title"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                                placeholder="Event title" value="{{ old('title') }}">
                            @error('title')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- country --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="country_id" class="block g-md-2 text-sm font-medium">Country</label>
                            <select id="country_id" name="country_id" x-model="country" x-on:change="onCountryChange"
                                class="border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-blue-400">
                                <option value="">Choose a Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- city --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="city_id" class="block g-md-2 text-sm font-medium">City</label>
                            <select id="city_id" name="city_id"
                                class="border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-blue-400">
                                <option value="">Choose a City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('city_id')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Image --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="image" class="text-sm font-medium">Upload Image</label>
                            <input type="file" id="image" name="image">
                            @error('image')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="address" class="block g-md-2 text-sm font-medium">Address</label>
                            <input type="text" id="address" name="address"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                                placeholder="Event address" value="{{ old('address') }}">
                            @error('address')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- start date --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="start_date" class="text-sm font-medium">Start Date</label>
                            <input type="date" id="start_date" name="start_date"
                                class="w-full text-sm border border-gray-300 rounded-lg cursor-pointer"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- end date --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="end_date" class="text-sm font-medium">End Date</label>
                            <input type="date" id="end_date" name="end_date"
                                class="w-full text-sm border border-gray-300 rounded-lg cursor-pointer"
                                value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- start time --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="start_time" class="text-sm font-medium">Start Time</label>
                            <input type="time" id="start_time" name="start_time"
                                class="w-full text-sm border border-gray-300 rounded-lg cursor-pointer"
                                value="{{ old('start_time') }}">
                            @error('start_time')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- num tickets --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="num_tickets" class="text-sm font-medium">Tickets Number</label>
                            <input type="number" id="num_tickets" name="num_tickets"
                                class="w-full text-sm border border-gray-300 rounded-lg cursor-pointer"
                                value="{{ old('num_tickets') }}">
                            @error('num_tickets')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- description --}}
                        <div class="grid gap-2 mb-6 md:grid-cols-2">
                            <label for="description" class="text-sm font-medium">Description</label>
                            <textarea name="description" id="description"
                                class="block p-2 w-full text-sm rounded-lg border border-gray-300 focus:ring-blue-500" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- tags --}}
                        <div>
                            <h3 class="mb-4 font-semibold">Tags</h3>
                            <ul class="item-center w-full text-sm font-medium border border-gray-300 rounded-lg">
                                @foreach ($tags as $tag)
                                    <li
                                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input type="checkbox" id="vue-check-list" name="tags[]"
                                                value="{{ $tag->id }}" class="">
                                            <label for="vue-check-list"
                                                class="w-full py-3 ml-2 text-sm font-medium">{{ $tag->name }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white mt-4 px-4 py-2 rounded">Save
                            Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
