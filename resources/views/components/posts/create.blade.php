@push('style')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
@endpush

<div class="relative max-w-4xl rounded-lg bg-white p-4 sm:p-5 dark:bg-gray-800">
    {{-- validation error --}}
    @if ($errors->any())
        <div class="mb-4 flex rounded-lg bg-red-50 p-4 text-sm text-red-800 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="me-3 mt-[2px] inline h-4 w-4 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Danger</span>
            <div>
                <span class="font-medium">Ensure that these requirements are met:</span>
                <ul class="mt-1.5 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Modal body -->
    <form action="{{ route('dashboard.post.store') }}" method="POST" class="space-y-4" id="postForm">
        @csrf
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" name="title" id="title"
                class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="Type post title" autofocus value="{{ old('title') }}" />
        </div>
        <div>
            <label for="category" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select id="category" name="category_id"
                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                <option selected value="">Select post category</option>
                @foreach ($allCategories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="body" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Body</label>
            <textarea class="hidden" id="body" name="body" placeholder="Write post body here">{{ old('body') }}</textarea>
            <div id="editor"></div>
        </div>
        <div class="flex gap-3">
            <button type="submit"
                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4 focus:outline-none">
                <svg class="mr-1 -ml-1 h-6 w-6" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add new post
            </button>
            <a href="{{ route('dashboard.index') }}"
                class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                Cancel
            </a>
        </div>
    </form>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Write post body here...',
        });

        const postForm = document.getElementById('postForm');
        const postBody = document.getElementById('body');
        const quillEditor = document.getElementById('editor');

        const oldBody = `{{ old('body') }}`;
        if (oldBody.trim() !== '') {
            quill.root.innerHTML = oldBody;
        }
        
        postForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const content = quillEditor.children[0].innerHTML;
            postBody.value = content;
            postForm.submit();
        });
    </script>
@endpush
