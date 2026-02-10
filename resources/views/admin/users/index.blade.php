<x-layouts::app>
    <div class="p-6 pb-0 max-w-7xl mx-auto">
        <div class="mb-4 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">
                    {{ __('Usuarios') }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('Manage system users') }}
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
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[220px]">
                            {{ __('User') }}
                        </th>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[280px]">
                            {{ __('Email') }}
                        </th>
                        <th class="px-10 py-4 text-left text-xs font-medium text-gray-400 uppercase min-w-[240px]">
                            {{ __('Created at') }}
                        </th>
                        <th class="px-10 py-4 text-right text-xs font-medium text-gray-400 uppercase min-w-[180px]">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-10 py-5 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $user->name }}
                                </span>
                            </td>

                            <td class="px-10 py-5 whitespace-nowrap text-sm text-gray-400">
                                {{ $user->email }}
                            </td>

                            <td class="px-10 py-5 whitespace-nowrap text-sm text-gray-400">
                                {{ $user->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-10 py-5 whitespace-nowrap">
                                <div class="flex justify-end gap-6">
                                    <a
                                        href="{{ route('dashboard.users.edit', $user) }}"
                                        class="text-indigo-400"
                                    >
                                        {{ __('Edit') }}
                                    </a>

                                    <form
                                        action="{{ route('dashboard.users.destroy', $user) }}"
                                        method="POST"
                                    >
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
                            <td colspan="4" class="px-10 py-12 text-center text-gray-400">
                                {{ __('No users found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="px-10 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>
