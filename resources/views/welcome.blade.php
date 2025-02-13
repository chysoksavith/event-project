<x-main-layout>
    <section class="bg-white">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl">Latest Events</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($events as $event)
                    <div class="lg:flex bg-slate-100 rounded-md">
                        <div>
                            <img class="object-cover w-full h-56 rounded-lg lg:w-64"
                                src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->title }}">
                        </div>

                        <div class="flex flex-col justify-between py-6 lg:mx-6">
                            <a href="{{ route('eventShow', $event->id) }}"
                                class="text-xl font-semibold text-gray-800 hover:underline">
                                {{ $event->title }}
                            </a>

                            <span class="text-sm  bg-indigo-400 rounded-md p-2">{{ $event->country->name }}</span>
                            <span class="flex flex-wrap space-x-2">
                                @foreach ($event->tags as $tag)
                                    <p class="text-sm p-1 bg-slate-200 rounded-md">{{ $tag->name }}</p>
                                @endforeach
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-main-layout>
