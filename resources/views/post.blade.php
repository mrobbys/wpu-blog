<x-layout :title="$title">
    <main class="bg-white pt-8 pb-16 antialiased lg:pt-16 lg:pb-24">
        <div class="mx-auto flex max-w-4xl justify-between px-4">
            <article class="format format-sm sm:format-base lg:format-lg format-blue mx-auto w-full max-w-2xl">
                <a href="/posts" class="text-sm text-gray-500 no-underline hover:underline">
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
</x-layout>
