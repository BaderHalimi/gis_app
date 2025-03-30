<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-6">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3" style="margin-bottom: 1rem;">
            <div class="relative overflow-hidden">
                {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Messages') }}</h1>
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
                                Email</th>
                            <th colspan="2"
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                Message</th>
                            {{-- <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                Longitude</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach ($messages as $message)
                            <tr
                                class="hover:bg-gray-50 dark:hover:bg-gray-800 transition border-b dark:border-gray-200">
                                <td style="padding:0.5rem 0;"
                                    class="px-6 text-center font-semibold py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $message->id }}</td>
                                <td style="padding:0.5rem 0;"
                                    class="px-6 text-center font-semibold py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $message->name }}</td>
                                <td style="padding:0.5rem 0;"
                                    class="px-6 text-center font-semibold py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $message->email }}</td>

                                <td colspan="2" style="padding:0.5rem 0;"
                                    class="px-6 text-center font-semibold py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $message->message }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $messages->links() }}
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
