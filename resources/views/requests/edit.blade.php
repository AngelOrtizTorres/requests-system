<x-layouts::public>
    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('requests.index.public') }}" class="text-blue-600 dark:text-blue-400 hover:underline mb-6 inline-block">
            ← {{ __('Back to Requests') }}
        </a>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md p-8 border border-zinc-200 dark:border-zinc-700">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('Edit Request') }}
                </h1>

                <form action="{{ route('requests.update', $request) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Title') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            value="{{ old('title', $request->title) }}"
                            maxlength="255"
                            required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg dark:bg-zinc-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            placeholder="{{ __('Enter request title') }}"
                        >
                        @error('title')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Description') }} <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="6"
                            required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg dark:bg-zinc-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                            placeholder="{{ __('Enter request description') }}"
                        >{{ old('description', $request->description) }}</textarea>
                        @error('description')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tag -->
                    <div class="mb-6">
                        <label for="tag_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Tag') }} <span class="text-gray-500 text-xs">({{ __('Optional') }})</span>
                        </label>
                        <select 
                            id="tag_id" 
                            name="tag_id"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg dark:bg-zinc-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tag_id') border-red-500 @enderror"
                        >
                            <option value="">-- {{ __('Select a tag') }} --</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" @selected(old('tag_id', $request->tag_id) == $tag->id)>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tag_id')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Display (Read-only) -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Status') }}
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                disabled
                                value="{{ ucfirst($request->status_id) }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg dark:bg-zinc-600 dark:text-gray-300 bg-gray-100 text-gray-600 cursor-not-allowed"
                            >
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">{{ __('Status can only be changed by administrators') }}</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <button 
                            type="submit"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                        >
                            {{ __('Update Request') }}
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
    </div>
</x-layouts::public>
