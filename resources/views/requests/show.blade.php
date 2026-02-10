<x-layouts::public>
    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('requests.index.public') }}" class="text-blue-600 dark:text-blue-400 hover:underline mb-6 inline-block">
            ← {{ __('Back to Requests') }}
        </a>

        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md p-8 border border-zinc-200 dark:border-zinc-700">
                <div class="flex items-start justify-between mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $request->title }}
                    </h1>
                    <div class="flex gap-2">
                        <a 
                            href="{{ route('requests.edit.public', $request) }}" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                        >
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('requests.destroy', $request) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                onclick="return confirm('{{ __('Are you sure?') }}')"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors"
                            >
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="mb-6">
                    @if($request->status_id === 'pending')
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                            {{ ucfirst($request->status_id) }}
                        </span>
                    @elseif($request->status_id === 'approved')
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                            {{ ucfirst($request->status_id) }}
                        </span>
                    @elseif($request->status_id === 'rejected')
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                            {{ ucfirst($request->status_id) }}
                        </span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('Description') }}
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
                        {{ $request->description }}
                    </p>
                </div>

                <!-- Tag -->
                @if($request->tag)
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Tag') }}
                    </h3>
                    <span class="inline-block px-3 py-1 rounded-full text-sm bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                        {{ $request->tag->name }}
                    </span>
                </div>
                @endif

                <!-- Metadata -->
                <div class="border-t border-gray-200 dark:border-zinc-700 pt-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Created at') }}
                            </h3>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ $request->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        @if($request->created_at->ne($request->updated_at))
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Updated at') }}
                            </h3>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ $request->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::public>
