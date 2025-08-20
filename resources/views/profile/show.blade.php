<x-app-layout>

    <div class="py-12">
        <div class="mx-auto flex max-w-7xl space-y-6 sm:px-6 lg:px-8">
            {{-- Left --}}
            <section class="flex flex-1 flex-col gap-6">

                <header>
                    <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                </header>

                @forelse ($posts as $post)
                    <article class="max-w-sm rounded-lg border border-gray-200 bg-white shadow-sm">
                        <a
                            href="{{ route('posts.show', ['username' => $post->user->username, 'slug' => $post->slug]) }}">
                            <img class="size-64 rounded-t-lg object-cover" src="{{ Storage::url($post->image) }}"
                                onerror="this.src='https://picsum.photos/400'" alt="" />
                        </a>
                        <div class="p-5">
                            <a
                                href="{{ route('posts.show', ['username' => $post->user->username, 'slug' => $post->slug]) }}">
                                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                    {{ $post->title }}</h2>
                            </a>
                            <p class="mb-3 font-normal text-gray-700">{{ Str::words($post->content, 20) }}...
                            </p>
                            <a href="{{ route('posts.show', ['username' => $post->user->username, 'slug' => $post->slug]) }}"
                                class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                Read more
                                <svg class="ms-2 h-3.5 w-3.5 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-500">No posts available.</p>
                @endforelse
            </section>
            {{-- Right --}}
            <section class="w-80">
                <section class="flex flex-col gap-4">
                    @if ($user->image)
                        <img class="size-16 rounded-full object-cover" src="{{ Storage::url($user->image) }}"
                            alt="{{ $user->name }}" />
                    @else
                        <img class="size-16 rounded-full object-cover"
                            src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="{{ $user->name }}" />
                    @endif
                    <div class="flex flex-col">
                        <span class="font-semibold">{{ $user->username }}</span>
                        <span class="text-sm text-gray-500">{{ $user->followers()->count() }} followers</span>
                    </div>
                    @if ($user->bio)
                        <p>{{ $user->bio }}</p>
                    @endif

                    <div>
                        <button class="rounded-3xl bg-green-500 px-6 py-2 text-white" type="button">Follow</button>
                    </div>
                </section>
            </section>
        </div>
    </div>
</x-app-layout>
