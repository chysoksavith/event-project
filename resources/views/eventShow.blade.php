<x-main-layout>
    <!-- component -->
    <section>
        <div class="container-page">
            <div class="left-container">
                <div class="image-container">
                    <img class="image-event" src="{{ asset('/storage/' . $event->image) }}" alt="">
                    @auth
                        <div class="container-btn" x-data="{
                            eventLike: @js($like),
                            onHandleLike() {
                                axios.post(`/events-like/{{ $event->id }}`).then(res => {
                                    this.eventLike = res.data
                                })
                            }
                        
                        }">
                            <button type="button" @click="onHandleLike" class="btn-css"
                                :class="eventLike ? 'text-blue-500' : 'text-white'">
                                <i class="fas fa-thumbs-up"></i> Like
                            </button>
                            <button class="btn-css">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button class="btn-css">
                                <i class="fas fa-calendar-check"></i> Attending
                            </button>

                        </div>
                    @endauth
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
                        <i class="fas fa-map-marker-alt"></i> {{ $event->country->name }}, {{ $event->city->name }}
                    </span>
                </div>

                <div class="mb-3">
                    Start : &nbsp; <span
                        class="mx-2">{{ \Carbon\Carbon::parse($event->start_date)->format('m/d/Y') }}</span> |
                    <span class="mx-2">{{ \Carbon\Carbon::parse($event->end_date)->format('m/d/Y') }}</span>

                </div>
                <div class="mb-3">
                    <span class="text-normal">
                        {{ $event->description }}
                    </span>
                </div>
                <div class="mb-3">
                    @auth
                        <div class="container">
                            <div class="input-wrapper">
                                <input type="email" class="input-field" placeholder="Comment" />
                                <button class="button" type="button">Save</button>
                            </div>
                        </div>

                    @endauth
                </div>
            </div>
        </div>
    </section>


</x-main-layout>
