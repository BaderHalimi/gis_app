<form action="{{ route('stations.store') }}" method="POST" class="space-y-6" wire:submit.prevent="save">
    @csrf
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <label for="name"
                class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" wire:model.lazy="name" required
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="type"
                class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Type</label>
            <select name="type" id="type" wire:model.lazy="type" required
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="gas">Gas</option>
                <option value="petrol">Petrol</option>
                <option value="fire">Fire</option>
            </select>
        </div>

        <div>
            <label for="lat"
                class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Latitude</label>
            <input type="text" name="lat" id="lat" placeholder="Latitude" wire:model.lazy="lat" required
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="lng"
                class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Longitude</label>
            <input type="text" name="lng" id="lng" placeholder="Longitude" wire:model.lazy="lng" required
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
    </div>

    <div>
        <button type="submit"
            class="inline-flex items-center px-5 py-2 text-white text-sm font-medium rounded-md shadow border border-gray-200 transition-all duration-200 hover:bg-white hover:text-gray-600">
            + @if($this->stationId != null) Edit @else Add @endif Station
        </button>
    </div>
</form>
