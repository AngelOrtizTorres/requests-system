<x-layouts::app>

    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard.index')">{{ __('Dashboard') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('dashboard.tags.index')" current>{{ __('Tags') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item current>{{ __('Edit') }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="card">

        <form action="{{ route('dashboard.tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')
            <flux:input
                label="{{ __('Tag Name') }}"
                name="name"
                placeholder="{{ __('Enter the modified tag name') }}"
                value="{{ old('name', $tag->name) }}">
            </flux:input>

            <div class="flex justify-end mt-4">
                <flux:button type="submit" variant="primary">{{ __('Update Tag') }}</flux:button>
            </div>
        </form>

    </div>
    
</x-layouts::app>