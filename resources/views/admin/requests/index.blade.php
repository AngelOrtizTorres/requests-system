<x-layouts::app>
    <div class="p-6 pb-0 max-w-7xl mx-auto">
        <div class="mb-4 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">
                    {{ __('All Requests') }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('Manage all user requests') }}
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="flex justify-center">
        <div class="inline-block bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden px-6">
            <table class="w-auto mx-auto divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[260px]">
                            {{ __('Title') }}
                        </th>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[220px]">
                            {{ __('User') }}
                        </th>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[140px]">
                            {{ __('Status') }}
                        </th>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[160px]">
                            {{ __('Tag') }}
                        </th>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[220px]">
                            {{ __('Created at') }}
                        </th>
                        <th class="px-10 py-4 text-right text-xs font-medium text-gray-400 uppercase min-w-[200px]">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($requests as $request)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-10 py-5 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $request->title }}
                                    </span>
                                    <span class="text-sm text-gray-400 truncate max-w-xs">
                                        {{ Str::limit($request->description, 50) }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-10 py-5 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $request->user->name }}
                                </div>
                                <div class="text-sm text-gray-400">
                                    {{ $request->user->email }}
                                </div>
                            </td>

                            <td class="px-10 py-5 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                        'approved' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                        'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    ];
                                @endphp

                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$request->status_id] ?? '' }}">
                                    {{ ucfirst($request->status_id) }}
                                </span>
                            </td>

                            <td class="px-10 py-5 whitespace-nowrap">
                                @if($request->tag)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $request->tag->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>

                            <td class="px-10 py-5 text-sm text-gray-400 whitespace-nowrap">
                                {{ $request->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-10 py-5 whitespace-nowrap">
                                <div class="flex justify-end gap-6">
                                    <a href="{{ route('dashboard.requests.show', $request) }}" class="text-blue-400">
                                        {{ __('View') }}
                                    </a>
                                    <a href="{{ route('dashboard.requests.edit', $request) }}" class="text-indigo-400">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('dashboard.requests.destroy', $request) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            onclick="return confirm('{{ __('Are you sure?') }}')"
                                            class="text-red-500"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-10 py-12 text-center text-gray-400">
                                {{ __('No requests found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
             @if($requests->hasPages())
                <div class="px-10 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>
