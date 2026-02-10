<x-layouts::app>
    <div class="mb-8 flex justify-between">
        <flux:breadcrumbs class="mb-8">
            <flux:breadcrumbs.item :href="route('dashboard.index')">{{ __('Dashboard') }}</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('dashboard.users.index')">{{ __('Usuarios') }}</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('dashboard.users.edit', $user)" current>{{ __('Edit') }}</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6">{{ __('Edit') }} - {{ $user->name }}</h2>

        <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">{{ __('Name') }}</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-700">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">{{ __('Email') }}</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-700">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn btn-default">{{ __('Update') }}</button>
                <a href="{{ route('dashboard.users.index') }}" class="btn btn-default">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>

</x-layouts::app>