<div class="flex items-center justify-center min-h-screen bg-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-4xl bg-gray-700 shadow overflow-hidden sm:rounded-lg">
        @if ($errors->any())
            <div id="errors" class="bg-red-500 text-white p-3 rounded shadow-sm">
                <strong class="font-bold">Error</strong>
                <span class="block sm:inline">Please review the form again.</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('message'))
            <div id="successMessage" class="bg-green-500 text-white p-3 rounded shadow-sm">
                <strong class="font-bold">Success!</strong>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-6 py-6 px-8">
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-300">Brand</label>
                <input wire:model="brand" id="brand" type="text" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 bg-gray-800 text-white" required>
            </div>

            <div>
                <label for="model" class="block text-sm font-medium text-gray-300">Model</label>
                <input wire:model="model" id="model" type="text" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 bg-gray-800 text-white" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea wire:model="description" id="description" rows="3" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 bg-gray-800 text-white"></textarea>
            </div>

            <div>
                <label for="expected_price" class="block text-sm font-medium text-gray-300">Expected Price</label>
                <input wire:model="expected_price" id="expected_price" type="text" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 bg-gray-800 text-white">
            </div>

            <div x-data="{ uploading: false, progress: 0 }"
                 x-on:livewire-upload-start="uploading = true"
                 x-on:livewire-upload-finish="uploading = false; progress = 0;"
                 x-on:livewire-upload-progress="progress = $event.detail.progress">
                <label for="images" class="block text-sm font-medium text-gray-300">Images</label>
                <input wire:model="images" id="images" type="file" class="w-full" multiple>
                @error('images.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <div x-show="uploading" class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-900 h-2.5 rounded-full" :style="{ width: `${progress}%` }"></div>
                    </div>
                </div>
            </div>

            <!-- Prikaz učitanih slika -->
          

            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Submit
            </button>
        </form>
    </div>
</div>
