<x-layouts::public>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <a href="{{ route('requests.index.public') }}" class="text-blue-600 dark:text-blue-400 hover:underline mb-4 inline-block">
                ← {{ __('Back to Requests') }}
            </a>
            <h1 class="text-3xl font-bold mb-4">{{ __('Create Request') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('Submit a new request') }}</p>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md p-8 border border-zinc-200 dark:border-zinc-700">
                <form action="{{ route('dashboard.requests.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Title') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="{{ __('Enter request title') }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        />
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Description') }} <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            placeholder="{{ __('Enter request description') }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tag Field -->
                    <div>
                        <label for="tag_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Tag') }} <span class="text-gray-500 text-xs">({{ __('Optional') }})</span>
                        </label>
                        <select
                            id="tag_id"
                            name="tag_id"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">-- {{ __('Select a tag') }} --</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" @selected(old('tag_id') == $tag->id)>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tag_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-4 justify-end pt-4 border-t border-gray-200 dark:border-zinc-600">
                        <a href="{{ route('requests.index.public') }}" class="btn btn-default">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-success">
                            {{ __('Create Request') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::public>