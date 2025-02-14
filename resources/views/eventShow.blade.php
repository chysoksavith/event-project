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
                            savedEvent: @js($savedEvent),
                            attending: @js($attending),
                            onHandleLike() {
                                axios.post(`/events-like/{{ $event->id }}`).then(res => {
                                    this.eventLike = res.data
                                })
                            },
                            onHandleSaved() {
                                axios.post(`/events-save/{{ $event->id }}`).then(res => {
                                    this.savedEvent = res.data
                                })
                            },
                            onHandleAttending() {
                                axios.post(`/events-attending/{{ $event->id }}`).then(res => {
                                    this.attending = res.data
                                })
                            }
                        
                        }">
                            <button type="button" @click="onHandleLike" class="btn-css"
                                :class="eventLike ? 'text-blue-500' : 'text-white'">
                                <i class="fas fa-thumbs-up"></i> Like
                            </button>
                            <button class="btn-css" type="button" @click="onHandleSaved"
                                :class="savedEvent ? 'text-blue-500' : 'text-white'">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button class="btn-css" @click="onHandleAttending"
                                :class="attending ? 'text-blue-500' : 'text-white'">
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
                        <div class="container max-w-lg mx-auto bg-white p-4 rounded-lg shadow-md">
                            <!-- Comment Input -->
                            <div class="mb-4">
                                <form action="{{ route('events.comment', $event->id) }}" method="POST"
                                    class="flex items-center space-x-2">
                                    @csrf
                                    <input type="text" name="content"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Write a comment..." />
                                    <button class="bg-blue-600  px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                                        type="submit">
                                        Post
                                    </button>
                                </form>
                            </div>

                            <!-- Comments List -->
                            <div class="space-y-4">
                                @foreach ($event->comments as $comment)
                                    <div class="bg-gray-100 p-5 rounded-lg shadow-sm  mb-3 ">
                                        <div class="flex justify-between items-center  p-5">
                                            <p class="font-semibold text-gray-700">{{ $comment->user->name }}</p>
                                            @if (Auth::user()->id === $comment->user_id)
                                                <form
                                                    action="{{ route('events.comment.destroy', [$event->id, $comment->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                        <p class="text-gray-600 mt-1">{{ $comment->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    @endauth
                </div>
            </div>
        </div>
    </section>


</x-main-layout>
