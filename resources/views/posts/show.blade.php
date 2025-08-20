<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Posts') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h1 class="p-6 text-3xl font-bold text-gray-900">
                    {{ $post->title }}
                </h1>
                <hr>
                <section class="p-6">
                    <div class="flex gap-6">

                        @if ($post->user->image)
                            <img class="size-16 rounded-full object-cover" src="{{ Storage::url($post->user->image) }}"
                                alt="{{ $post->user->name }}" />
                        @else
                            <img class="size-16 rounded-full object-cover"
                                src="https://ui-avatars.com/api/?name={{ $post->user->name }}"
                                alt="{{ $post->user->name }}" />
                        @endif
                        <div class="my-auto">

                            <div>
                                <a href="{{ route('profile.show', $post->user->username) }}"
                                    class="hover:underline">{{ $post->user->username }}</a>
                                <span>•</span>
                                <button class="" type="button" x-data="{ isFollowing: {{ $post->user->followers()->where('follower_id', Auth::id())->exists() ? 'true' : 'false' }}, }"
                                    x-text="isFollowing ? 'Unfollow' : 'Follow'"
                                    :class="isFollowing ? 'text-red-500' : 'text-green-500'"
                                    @click="fetch('/follow/' + {{ $post->user->id }}, {
                                method: 'POST',
                                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                            'X-CSRF-Token': '{{ csrf_token() }}'
                            }
                            }).then(res => res.json()).then(data => {
                                isFollowing = data.following;
                            })"></button>
                            </div>
                            <div class="text-sm text-gray-500">
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                <span>•</span>
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="pt-6">
                        <button type="button" x-data="{
                            liked: {{ $post->likes()->where('user_id', Auth::id())->exists() ? 'true' : 'false' }},
                            likes_count: {{ $post->likes()->count() }}
                        }"
                            @click="fetch('/posts/like/' + {{ $post->id }}, {
                                method: 'POST',
                                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                            'X-CSRF-Token': '{{ csrf_token() }}'
                            }
                            }).then(res => res.json()).then(data => {
                                liked = data.liked;
                                likes_count = data.likes_count;
                            })"
                            class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700"
                            :class="liked ? 'text-green-500' : 'text-gray-500'">
                            <span class="sr-only" x-text="liked ? 'Unlike post' : 'Like post'"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                            </svg>
                            <span x-text="likes_count"></span>
                        </button>
                    </div>
                </section>
                <hr>
                <section>
                    <div class="p-6 text-gray-900">
                        <img class="w-full rounded-lg object-cover" src="{{ Storage::url($post->image) }}"
                            onerror="this.src='https://picsum.photos/400'" alt="" />
                        <p class="mt-4">{{ $post->content }}</p>
                        <div class="mt-4">
                            <a href="#"
                                class="inline-block rounded-lg bg-gray-100 px-4 py-3 hover:text-gray-900">{{ $post->category->name }}</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
