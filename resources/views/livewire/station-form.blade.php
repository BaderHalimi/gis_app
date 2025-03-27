<form action="{{ route('stations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6"
    wire:submit.prevent="save">
    @csrf
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        {{-- Name --}}
        <div>
            <label for="name" class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" wire:model.lazy="name" required
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        {{-- Type --}}
        <div>
            <label for="type" class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Type</label>
            <select name="type" id="type" wire:model.lazy="type" required
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="gas">Gas</option>
                <option value="petrol">Petrol</option>
                <option value="fire">Fire</option>
            </select>
        </div>

        {{-- Latitude --}}
        <div>
            <label for="lat"
                class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Latitude</label>
            <input type="text" name="lat" id="lat" placeholder="Latitude" wire:model.lazy="lat" required
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        {{-- Longitude --}}
        <div>
            <label for="lng"
                class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Longitude</label>
            <input type="text" name="lng" id="lng" placeholder="Longitude" wire:model.lazy="lng" required
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        {{-- Address --}}
        <div class="sm:col-span-2">
            <label for="address"
                class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Address</label>
            <input type="text" name="address" id="address" placeholder="Station Address" wire:model.lazy="address"
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        {{-- Description --}}
        <div class="sm:col-span-2">
            <label for="description"
                class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Details about the station..."
                wire:model.lazy="description"
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        {{-- Prices (as key:value string) --}}
        <div class="sm:col-span-2">
            <label for="prices" class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Prices (e.g.
                Diesel=5.5, Gas=6)</label>
            <input type="text" name="prices" id="prices" placeholder="FuelType=Price, separate by comma"
                wire:model.lazy="prices"
                class="w-full rounded-md border border-white py-3 px-4 dark:border-neutral-700 dark:bg-neutral-800 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        {{-- Images --}}
        <div class="sm:col-span-2">
            <label for="images" class="block mb-1 text-sm font-medium text-gray-200 dark:text-gray-200">Images</label>
            <input type="file" multiple name="images[]" id="images" wire:model="images" accept="image/*"
                class="block w-full text-sm text-gray-900 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
        </div>
    </div>

    {{-- Submit --}}
    <div>
        <button type="submit"
            class="inline-flex items-center px-5 py-2 text-white text-sm font-medium rounded-md shadow border border-gray-200 transition-all duration-200 hover:bg-white hover:text-gray-600">
            + @if ($this->stationId != null)
                Edit
            @else
                Add
            @endif Station
        </button>
    </div>
</form>
