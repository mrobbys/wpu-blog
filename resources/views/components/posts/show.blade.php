
<main class="bg-white pt-8 pb-16 antialiased lg:pt-16 lg:pb-24">
    <div class="mx-auto flex max-w-4xl justify-between px-4">
        <article class="format format-sm sm:format-base lg:format-lg format-blue mx-auto w-full max-w-2xl">
            <a href="{{ route('dashboard.index') }}" class="text-sm text-gray-500 no-underline hover:underline">
                &laquo; Back to all Posts
            </a>
            <header class="not-format my-4 lg:my-6">
                <address class="mb-6 flex items-center not-italic">
                    <div class="mr-3 inline-flex items-center text-sm text-gray-900">
                        <img
                            class="mr-4 h-16 w-16 rounded-full"
                            src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/avatar.png') }}"
                            alt="{{ $post->author->name }}"
                        />
                        <div>
                            <a
                                href="/authors/{{ $post->author->id }}"
                                rel="author"
                                class="text-xl font-bold text-gray-900"
                            >
                                {{ $post->author->name }}
                            </a>
                            <a
                                href="/categories/{{ $post->category->slug }}"
                                class="{{ $post->category->color }} block w-fit rounded px-2.5 py-0.5 text-xs font-medium text-gray-600"
                            >
                                {{ $post->category->name }}
                            </a>
                            <p class="text-base text-gray-500">
                                <time
                                    pubdate
                                    datetime="{{ $post->created_at->format('Y-m-d') }}"
                                    title="{{ $post->created_at->format('F jS, Y') }}"
                                >
                                    {{ $post->created_at->format('M. d, Y') }}
                                </time>
                            </p>
                        </div>
                    </div>
                </address>

                <div class="mb-4 flex items-center gap-2">
                    <a
                        href="{{ route('dashboard.post.edit', $post->slug) }}"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4 focus:outline-none"
                    >
                        <svg
                            aria-hidden="true"
                            class="mr-1 -ml-1 h-5 w-5"
                            fill="currentColor"
                            viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path
                                fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Edit
                    </a>
                    <button
                        type="button"
                        class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900"
                    >
                        <svg
                            aria-hidden="true"
                            class="mr-1.5 -ml-1 h-5 w-5"
                            fill="currentColor"
                            viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Delete
                    </button>
                </div>

                <h1 class="mb-4 text-3xl leading-tight font-extrabold text-gray-900 lg:mb-6 lg:text-4xl">
                    {{ $post['title'] }}
                </h1>
            </header>
            <div class="post-content">
                {!! $post['body'] !!}
            </div>
        </article>
    </div>
</main>
