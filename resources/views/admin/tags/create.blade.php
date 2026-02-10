<x-layouts::app>
    <div class="p-6 pb-0">
        <div class="mb-8">
            <a href="{{ route('dashboard.tags.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline mb-4 inline-block">
                ← {{ __('Back to Tags') }}
            </a>
            <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">{{ __('Create Tag') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('Add a new tag to organize requests') }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="max-w-2xl">
            <div class="p-8">
                <form action="{{ route('dashboard.tags.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Tag Name') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('Enter the tag name') }}"
                            maxlength="255"
                            required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        />
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-4 justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('dashboard.tags.index') }}" class="btn btn-default">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-success">
                            {{ __('Create Tag') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>