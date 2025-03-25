<x-layouts.app :title="__('Dashboard')">
    <div class="flex flex-col gap-6 p-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Edit Station') }}</h1>
            <a href="{{ route('stations.index') }}" class="text-sm text-blue-400 hover:underline">← Back to list</a>
        </div>

        <div class="shadow-md rounded-xl p-6">
            <livewire:station-form :id="$station->id" />

        </div>
    </div>
</x-layouts.app>
