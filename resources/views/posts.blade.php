<x-layout :title="$title ?? 'Blog Page'">
    <div class="mx-auto max-w-screen-xl px-4 pb-10 lg:px-6">
        <form class="mx-auto my-5 max-w-md" method="GET">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}" />
            @endif

            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}" />
            @endif

            <label for="default-search" class="sr-only mb-2 text-sm font-medium text-gray-900">Search</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                    <svg
                        class="h-4 w-4 text-gray-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 20 20"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                        />
                    </svg>
                </div>
                <input
                    type="search"
                    id="default-search"
                    name="search"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Search post title..."
                    autofocus
                    autocomplete="off"
                    value="{{ request('search') }}"
                />
                <button
                    type="submit"
                    class="absolute end-2.5 bottom-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none"
                >
                    Search
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article class="flex flex-col rounded-lg border border-gray-200 bg-white p-6 shadow-md">
                    <div class="mb-5 flex items-center justify-between text-gray-500">
                        <a
                            href="/posts?category={{ $post->category->slug }}"
                            class="{{ $post->category->color }} inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium text-gray-600"
                        >
                            {{ $post->category->name }}
                        </a>
                        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex-1">
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            <a href="/posts/{{ $post['slug'] }}">{{ $post->title }}</a>
                        </h2>
                        <div class="mb-5 font-light text-gray-500">
                            {!! Str::limit($post->body, 70) !!}
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <a href="/posts?author={{ $post->author->username }}" class="flex items-center space-x-4">
                            <img
                                class="h-7 w-7 rounded-full"
                                src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/avatar.png') }}"
                                alt="{{ $post->author->name }}"
                            />
                            <span class="font-medium">
                                {{ $post->author->name }}
                            </span>
                        </a>
                        <a
                            href="/posts/{{ $post['slug'] }}"
                            class="text-primary-600 inline-flex items-center font-medium hover:underline"
                        >
                            Baca Selengkapnya
                            <svg
                                class="ml-2 h-4 w-4"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center">
                    <p class="text-lg font-semibold">No post found😭😭😭</p>
                    <a href="{{ route('posts') }}" class="text-primary-600 hover:underline">
                        &laquo; Back to all posts
                    </a>
                </div>
            @endforelse
        </div>
        <div class="py-10">
            {{ $posts->links() }}
        </div>
    </div>
</x-layout>
