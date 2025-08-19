<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <ul class="flex flex-wrap justify-center gap-4 text-center text-sm font-medium text-gray-500">
                        <li>
                            <a href="#" class="active inline-block rounded-lg bg-blue-600 px-4 py-3 text-white"
                                aria-current="page">All</a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="#"
                                    class="active inline-block rounded-lg bg-blue-600 px-4 py-3 text-white"
                                    aria-current="page">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        <li>
                            <a href="#" class="active inline-block rounded-lg bg-blue-600 px-4 py-3 text-white"
                                aria-current="page">Tab 1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="inline-block rounded-lg px-4 py-3 hover:bg-gray-100 hover:text-gray-900">Tab
                                2</a>
                        </li>

                    </ul>

                </div>

                <div class="p-6 text-gray-900">

                    <ul class="flex flex-wrap justify-center gap-6 text-center text-sm font-medium text-gray-500">
                        @foreach ($posts as $post)
                            <div class="max-w-sm rounded-lg border border-gray-200 bg-white shadow-sm">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    <img class="size-64 rounded-t-lg object-cover"
                                        src="{{ Storage::url($post->image) }}"
                                        onerror="this.src='https://picsum.photos/400'" alt="" />
                                </a>
                                <div class="p-5">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                            {{ $post->title }}</h2>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700">{{ Str::words($post->content, 20) }}...
                                    </p>
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                        Read more
                                        <svg class="ms-2 h-3.5 w-3.5 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </ul>

                </div>
            </div>
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
