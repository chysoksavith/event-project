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
    <div>
        @include('_message')

    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Table sadfdfa
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>
