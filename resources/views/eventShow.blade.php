<x-main-layout>
    <!-- component -->
    <section>
        <div class="container-page">
            <div class="left-container">
                <div class="image-container">
                    <img class="image-event" src="{{ asset('/storage/' . $event->image) }}" alt="">
                    <div class="container-btn ">
                        <button class="btn-css">
                            <i class="fas fa-thumbs-up"></i> Like
                        </button>
                        <button class="btn-css">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <button class="btn-css">
                            <i class="fas fa-calendar-check"></i> Attending
                        </button>

                    </div>
                    <div class="mb-3 mt-4">
                        <span class="text-normal1">
                            Host Info
                        </span>
                        <div class="container-info">
                            <p class="text-normal">
                                {{ $event->user->name }}
                            </p>
                            <p class="text-normal">
                                {{ $event->user->email }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="right-container">
                <div class="mb-1">
                    <span class="text-title">
                        {{ $event->title }}
                    </span>
                </div>
                <div class="mb-3">
                    <span class="text-normal">
                        <i class="fas fa-map-marker-alt"></i> {{ $event->country->name }}
                    </span>
                </div>

                <div class="mb-3">
                    Start : &nbsp; <span
                        class="mx-2">{{ \Carbon\Carbon::parse($event->start_date)->format('m/d/Y') }}</span> |
                    <span class="mx-2">{{ \Carbon\Carbon::parse($event->end_date)->format('m/d/Y') }}</span>

                </div>
                <div class="mb-3">
                    <span class="text-normal">
                        {{ $event->title }}
                    </span>
                </div>
            </div>
        </div>
    </section>


</x-main-layout>
