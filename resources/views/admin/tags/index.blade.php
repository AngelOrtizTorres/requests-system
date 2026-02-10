<x-layouts::app>
    <div class="p-6 pb-0 max-w-7xl mx-auto">
        <div class="mb-4 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">
                    {{ __('Tags') }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('Manage request tags') }}
                </p>
            </div>
            <a href="{{ route('dashboard.tags.create') }}" class="btn btn-success">
                {{ __('Create Tag') }}
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="flex justify-center">
        <!-- Contenedor igual al de Users -->
        <div class="inline-block bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden px-6">
            <table class="w-auto mx-auto divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[220px]">
                            {{ __('Name') }}
                        </th>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[260px]">
                            {{ __('Created at') }}
                        </th>
                        <th class="px-10 py-4 text-right text-xs font-medium text-gray-400 uppercase min-w-[180px]">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($tags as $tag)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-10 py-5 text-blue-400 whitespace-nowrap min-w-[220px]">
                                {{ $tag->name }}
                            </td>

                            <td class="px-10 py-5 text-sm text-gray-400 whitespace-nowrap min-w-[260px]">
                                {{ $tag->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-10 py-5 text-right whitespace-nowrap min-w-[180px]">
                                <div class="flex justify-end gap-6">
                                    <a href="{{ route('dashboard.tags.edit', $tag) }}" class="text-indigo-400">
                                        {{ __('Edit') }}
                                    </a>
                                    <button class="text-red-500">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             @if($tags->hasPages())
                <div class="px-10 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $tags->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>
