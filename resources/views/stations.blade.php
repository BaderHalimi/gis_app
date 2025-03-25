<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-6">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3" style="margin-bottom: 1rem;">
            <div class="relative overflow-hidden">
                {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Stations') }}</h1>
            </div>
            <div class="relative overflow-hidden">
                {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
            </div>
            <div class="relative overflow-hidden">
                <div class="flex justify-end">

                    {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                    <flux:button color="primary" icon="plus" :href="route('stations.create')" wire:navigate>
                        {{ __('Add Station') }}</flux:button>

                    {{-- <a href="{{ route('stations.create') }}"
                        class="inline-block px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg shadow">{{ __('Add Station') }}</a> --}}
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden">
            {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
            <div class="overflow-x-auto rounded-lg">
                <table style="width: 100%;" class="min-w-full w-100 divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                #</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                Name</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                Type</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                Latitude</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                Longitude</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach ($stations as $station)
                            <tr
                                class="hover:bg-gray-50 dark:hover:bg-gray-800 transition border-b dark:border-gray-200">
                                <td style="padding:0.5rem 0;"
                                    class="px-6 text-center font-semibold py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $station->id }}</td>
                                <td style="padding:0.5rem 0;"
                                    class="px-6 text-center font-semibold py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $station->name }}</td>
                                <td style="padding:0.5rem 0;" class="px-6 text-center font-semibold py-4 text-sm">
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-medium rounded-full
                                        @if ($station->type === 'gas') bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300
                                        @elseif($station->type === 'petrol') bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300
                                        @elseif($station->type === 'fire') bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300
                                        @else bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 @endif">
                                        {{ $station->type }}
                                    </span>
                                </td>
                                <td style="padding:0.5rem 0;"
                                    class="px-6 text-center font-semibold py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $station->lat }}</td>
                                <td style="padding:0.5rem 0;"
                                    class="px-6 text-center font-semibold py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $station->lng }}</td>
                                <td style="padding:0.5rem 0;" class="px-6 text-center font-semibold py-4 space-x-2">
                                    <a href="{{ route('stations.show', $station) }}"
                                        class="inline-block px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg shadow">View</a>
                                    <a href="{{ route('stations.edit', $station) }}"
                                        class="inline-block px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-lg shadow">Edit</a>
                                    <form id="delete-form-{{ $station->id }}"
                                        action="{{ route('stations.destroy', $station) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $station->id }})"
                                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg shadow">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $stations->links() }}
                </div>
            </div>

        </div>
    </div>
    <script>
        function confirmDelete(stationId) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لا يمكنك التراجع بعد الحذف!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${stationId}`).submit();
                }
            });
        }
    </script>

</x-layouts.app>
