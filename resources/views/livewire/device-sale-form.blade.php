   
    <div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[550px] bg-white shadow-lg rounded-lg overflow-hidden">
        
         @if ($errors->any())
        <div class="text-red-500 p-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <strong class="font-bold">Uspeh!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
        @endif
        <form wire:submit.prevent="submit" class="space-y-5 py-6 px-9" >
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Marka:</label>
                <input wire:model="brand" id="brand" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
            </div>

            <div>
                <label for="model" class="block text-sm font-medium text-gray-700">Model:</label>
                <input wire:model="model" id="model" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Opis problema:</label>
                <textarea wire:model="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"></textarea>
            </div>

            <div>
                <label for="expected_price" class="block text-sm font-medium text-gray-700">Očekivana cena:</label>
                <input wire:model="expected_price" id="expected_price" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Ime:</label>
                <input wire:model="name" id="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Adresa:</label>
                <input wire:model="address" id="address" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
            </div>

            <div>
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Poštanski broj:</label>
                <input wire:model="postal_code" id="postal_code" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
            </div>

            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">Grad:</label>
                <input wire:model="city" id="city" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
            </div>

                <div class="mb-5">
                <label for="images" class="block text-sm font-medium text-gray-700">Slike:</label>
                <input wire:model="images" id="images" type="file" class="w-full" multiple>
                @error('images.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <div wire:loading wire:target="images" class="mt-2 text-blue-500 text-sm">Učitavanje...</div>
                
                @if ($images)
                <div class="grid grid-cols-3 gap-4 mt-4">
                    @foreach ($images as $index => $image)
                    <div class="relative">
                        <img src="{{ $image->temporaryUrl() }}" alt="Pregled slike" class="rounded-lg shadow-md border border-gray-200">
                        <button type="button" wire:click="removeImage({{ $index }})" class="absolute top-0 right-0 bg-red-500 text-white p-1 rounded-full">&times;</button>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Pošalji
            </button>
            </form>
   




    @if ($showConfirmationModal)
<div 
    x-data="{ open: @entangle('showConfirmationModal') }"
    x-show="open"
    style="display: none;"
    class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center"
    x-init="console.log('Modal open:', open)">
    
    <div 
        x-show.transition.opacity="open"
        class="bg-white p-4 rounded-lg max-w-md mx-auto">
        <!-- Svi inputi kao disabled -->
        <div class="mb-3">
            <input value="{{ $brand }}" disabled class="w-full" />
        </div>
        <div class="mb-3">
            <input value="{{ $model }}" disabled class="w-full" />
        </div>
        <div class="mb-3">
            <textarea disabled class="w-full">{{ $description }}</textarea>
        </div>
        <div class="mb-3">
            <input value="{{ $expected_price }}" disabled class="w-full" />
        </div>
        <div class="mb-3">
            <input value="{{ $name }}" disabled class="w-full" />
        </div>
        <div class="mb-3">
            <input value="{{ $address }}" disabled class="w-full" />
        </div>
        <div class="mb-3">
            <input value="{{ $postal_code }}" disabled class="w-full" />
        </div>
        <div class="mb-3">
            <input value="{{ $city }}" disabled class="w-full" />
        </div>
        
        <!-- Prikaz uploadovanih slika (ako su dostupne) -->
        @if ($images)
        <div class="grid grid-cols-3 gap-4 mt-4">
            @foreach ($images as $index => $image)
            <div class="relative">
                <img src="{{ $image->temporaryUrl() }}" class="rounded-lg shadow-md border border-gray-200 w-full h-auto">
                <button wire:click="removeImage({{ $index }})" class="absolute top-0 right-0 bg-red-500 text-white p-1 rounded-full" title="Ukloni sliku">&times;</button>
            </div>
            @endforeach
        </div>
        @endif
        
        <div class="flex justify-end space-x-2 mt-4">
            <button x-on:click="open = false" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                Odustani
            </button>
            <button wire:click="finalSubmit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Potvrdi
            </button>
        </div>
    </div>
</div>
@endif

            <!-- Ostatak vaše komponente -->
        </div>

    

    


