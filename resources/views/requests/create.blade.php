<x-layouts::public>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('requests.index.public') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                <- {{ __('Back to Requests') }}
            </a>
        </div>

        <div class="max-w-2xl mx-auto bg-white dark:bg-zinc-800 rounded-lg shadow-md p-6 border border-zinc-200 dark:border-zinc-700">
            <h1 class="text-2xl font-bold mb-6">{{ __('Create Request') }}</h1>

            <form action="{{ route('requests.store.public') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        maxlength="255"
                        required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                        placeholder="{{ __('Enter request title') }}"
                    >
                    @error('title')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Description') }} <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                        placeholder="{{ __('Enter request description') }}"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="tag_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Tag') }} <span class="text-gray-500 text-xs">({{ __('Optional') }})</span>
                    </label>
                    <select
                        id="tag_id"
                        name="tag_id"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tag_id') border-red-500 @enderror"
                    >
                        <option value="">-- {{ __('Select a tag') }} --</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @selected(old('tag_id') == $tag->id)>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('tag_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button
                        type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                    >
                        {{ __('Create Request') }}
                    </button>
                    <a
                        href="{{ route('requests.index.public') }}"
                        class="px-6 py-2 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-700 text-gray-900 dark:text-white rounded-lg font-medium transition-colors"
                    >
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts::public>
