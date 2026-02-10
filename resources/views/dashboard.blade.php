<x-layouts::app :title="__('Dashboard')">
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">{{ __('Dashboard') }}</h1>
        
        <!-- Bento Grid -->
        <div class="relative rounded-3xl border border-slate-200/80 dark:border-slate-700/80 bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800 p-6 shadow-sm" style="font-family: 'Manrope', 'Sora', sans-serif;">
            <div class="grid grid-cols-1 md:grid-cols-6 xl:grid-cols-12 auto-rows-[120px] gap-4">
                <!-- Total Requests -->
                <div class="col-span-1 md:col-span-4 xl:col-span-5 row-span-2 rounded-2xl bg-white/90 dark:bg-slate-900/70 backdrop-blur ring-1 ring-slate-200/70 dark:ring-slate-700/70 shadow-sm hover:shadow-md transition-shadow p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">{{ __('Total Requests') }}</p>
                            <p class="mt-3 text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight">{{ $stats['requests_total'] }}</p>
                        </div>
                        <div class="p-3 rounded-2xl bg-emerald-100/80 dark:bg-emerald-900/40">
                            <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center gap-3 text-sm text-slate-500 dark:text-slate-400">
                        <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        <span>{{ __('Approved Requests') }}: <strong class="text-slate-900 dark:text-white">{{ $stats['requests_approved'] }}</strong></span>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="col-span-1 md:col-span-2 xl:col-span-3 row-span-2 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white shadow-md hover:shadow-lg transition-shadow p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-semibold text-white/90">{{ __('Total Users') }}</p>
                            <p class="mt-3 text-5xl font-extrabold tracking-tight">{{ $stats['users'] }}</p>
                        </div>
                        <div class="p-2.5 rounded-2xl bg-white/15">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-6 text-xs text-white/80">{{ __('Manage system users') }}</p>
                </div>

                <!-- Total Tags -->
                <div class="col-span-1 md:col-span-2 xl:col-span-4 row-span-1 rounded-2xl bg-white/90 dark:bg-slate-900/70 backdrop-blur ring-1 ring-slate-200/70 dark:ring-slate-700/70 shadow-sm hover:shadow-md transition-shadow p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ __('Total Tags') }}</p>
                            <p class="mt-1 text-3xl font-bold text-slate-900 dark:text-white">{{ $stats['tags'] }}</p>
                        </div>
                        <div class="p-2.5 rounded-xl bg-amber-100/80 dark:bg-amber-900/40">
                            <svg class="w-6 h-6 text-amber-700 dark:text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                
                <!-- Status Mix -->
                <div class="col-span-1 md:col-span-6 xl:col-span-5 row-span-2 rounded-2xl bg-white/90 dark:bg-slate-900/70 backdrop-blur ring-1 ring-slate-200/70 dark:ring-slate-700/70 shadow-sm hover:shadow-md transition-shadow p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">{{ __('Status') }}</p>
                        <span class="text-xs text-slate-500 dark:text-slate-400">{{ $stats['requests_total'] }} total</span>
                    </div>
                    <div class="mt-5 space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                <span>{{ __('Approved Requests') }}</span>
                                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ number_format(($stats['requests_total'] > 0 ? $stats['requests_approved'] / $stats['requests_total'] : 0) * 100, 0) }}%</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-slate-200/70 dark:bg-slate-700/70">
                                <div class="h-2 rounded-full bg-emerald-500" style="width: {{ $stats['requests_total'] > 0 ? ($stats['requests_approved'] / $stats['requests_total']) * 100 : 0 }}%;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                <span>{{ __('Pending Requests') }}</span>
                                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ number_format(($stats['requests_total'] > 0 ? $stats['requests_pending'] / $stats['requests_total'] : 0) * 100, 0) }}%</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-slate-200/70 dark:bg-slate-700/70">
                                <div class="h-2 rounded-full bg-amber-500" style="width: {{ $stats['requests_total'] > 0 ? ($stats['requests_pending'] / $stats['requests_total']) * 100 : 0 }}%;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                <span>{{ __('Rejected Requests') }}</span>
                                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ number_format(($stats['requests_total'] > 0 ? $stats['requests_rejected'] / $stats['requests_total'] : 0) * 100, 0) }}%</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-slate-200/70 dark:bg-slate-700/70">
                                <div class="h-2 rounded-full bg-rose-500" style="width: {{ $stats['requests_total'] > 0 ? ($stats['requests_rejected'] / $stats['requests_total']) * 100 : 0 }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Approved Requests -->
                <div class="col-span-1 md:col-span-3 xl:col-span-4 row-span-1 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-md hover:shadow-lg transition-shadow p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-white/90">{{ __('Approved Requests') }}</p>
                            <p class="mt-1 text-3xl font-bold">{{ $stats['requests_approved'] }}</p>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Pending Requests -->
                <div class="col-span-1 md:col-span-2 xl:col-span-4 row-span-1 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 text-white shadow-md hover:shadow-lg transition-shadow p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-white/90">{{ __('Pending Requests') }}</p>
                            <p class="mt-1 text-3xl font-bold">{{ $stats['requests_pending'] }}</p>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Rejected Requests -->
                <div class="col-span-1 md:col-span-3 xl:col-span-4 row-span-1 rounded-2xl bg-gradient-to-br from-rose-500 to-red-600 text-white shadow-md hover:shadow-lg transition-shadow p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-white/90">{{ __('Rejected Requests') }}</p>
                            <p class="mt-1 text-3xl font-bold">{{ $stats['requests_rejected'] }}</p>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
