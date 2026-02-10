<x-layouts::public>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ __('My Requests') }}</h1>
                <p class="text-gray-600 dark:text-gray-400">{{ __('View your requests') }}</p>
            </div>
            @if(auth()->check())
            <a href="{{ route('requests.create.public') }}" class="btn btn-success">
                {{ __('Create Request') }}
            </a>
            @endif
        </div>

        @if ($requests->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($requests as $request)
                <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md p-6 border border-zinc-200 dark:border-zinc-700 hover:shadow-lg transition">
                    <h2 class="text-xl font-bold mb-2 truncate">{{ $request->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">{{ $request->description }}</p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                            @if($request->status_id === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                            @elseif($request->status_id === 'approved') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                            @elseif($request->status_id === 'rejected') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                            @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                            @endif">
                            {{ ucfirst($request->status_id) }}
                        </span>
                        @if($request->tag_id)
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ $request->tag->name ?? 'N/A' }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-4 border-t pt-4">
                        <p class="mb-2">{{ __('Created at') }}: {{ $request->created_at->format('d/m/Y H:i') }}</p>
                        <p>{{ __('Updated at') }}: {{ $request->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('requests.show.public', $request) }}" class="flex-1 btn btn-default text-center">
                            {{ __('View') }}
                        </a>
                        <a href="{{ route('requests.edit.public', $request) }}" class="flex-1 btn btn-default text-center">
                            {{ __('Edit') }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $requests->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 dark:text-gray-400 text-lg mb-4">{{ __('No requests found') }}</p>
                @if(auth()->check())
                <a href="{{ route('requests.create.public') }}" class="btn btn-success">
                    {{ __('Create your first request') }}
                </a>
                @endif
            </div>
        @endif
    </div>
</x-layouts::public>