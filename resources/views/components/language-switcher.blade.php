@props(['class' => ''])

<flux:dropdown position="bottom" align="start" class="{{ $class }}">
    <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors w-full">
        <flux:icon.language variant="micro" />
        <span class="uppercase text-xs font-bold">{{ strtoupper(app()->getLocale()) }}</span>
    </button>

    <flux:menu>
        <flux:menu.item :href="route('change.language', 'en')">
            <span class="mr-2">🇬🇧</span>
            <span>English</span>
            @if(app()->getLocale() === 'en')
                <flux:icon.check class="ml-auto w-4 h-4" variant="micro" />
            @endif
        </flux:menu.item>
        <flux:menu.item :href="route('change.language', 'es')">
            <span class="mr-2">🇪🇸</span>
            <span>Español</span>
            @if(app()->getLocale() === 'es')
                <flux:icon.check class="ml-auto w-4 h-4" variant="micro" />
            @endif
        </flux:menu.item>
        <flux:menu.item :href="route('change.language', 'fr')">
            <span class="mr-2">🇫🇷</span>
            <span>Français</span>
            @if(app()->getLocale() === 'fr')
                <flux:icon.check class="ml-auto w-4 h-4" variant="micro" />
            @endif
        </flux:menu.item>
    </flux:menu>
</flux:dropdown>
