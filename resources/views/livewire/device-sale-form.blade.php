<div>
         @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
       @endif

        <form wire:submit.prevent="submit" class="space-y-4">
            <!-- Polja forme -->
            <input type="text" wire:model="name" placeholder="Ime i prezime" class="input input-bordered w-full max-w-xs" />
            <input type="text" wire:model="address" placeholder="Adresa" class="input input-bordered w-full max-w-xs" />
            <input type="text" wire:model="postal_code" placeholder="Poštanski broj" class="input input-bordered w-full max-w-xs" />
            <input type="text" wire:model="expected_price" placeholder="Poštanski broj" class="input input-bordered w-full max-w-xs" />

            <input type="text" wire:model="city" placeholder="Grad" class="input input-bordered w-full max-w-xs" />
            <input type="text" wire:model="brand" placeholder="Marka" class="input input-bordered w-full max-w-xs" />
            <input type="text" wire:model="model" placeholder="Model" class="input input-bordered w-full max-w-xs" />
            <textarea wire:model="description" placeholder="Opis problema" class="textarea textarea-bordered w-full max-w-xs"></textarea>
            <input type="file" wire:model="images" multiple class="block w-full text-sm text-gray-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700
            hover:file:bg-violet-100
            "/>

            <!-- Dugme za slanje -->
            <button type="submit" class="btn btn-primary">Pošalji</button>


        </form>

             <div x-data="{ showModal: @entangle('showConfirmationModal') }">
                 <div x-show="showModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-40 overflow-y-auto flex items-center justify-center">
                     <div class="bg-white p-5 rounded-lg z-50 m-4 space-y-4 w-full max-w-lg">
                         <!-- Pregled podataka kao disabled inputi -->
                         <input type="text" value="{{ $brand }}" class="input input-bordered w-full" disabled />
                         <input type="text" value="{{ $model }}" class="input input-bordered w-full" disabled />
                         <textarea class="textarea textarea-bordered w-full" disabled>{{ $description }}</textarea>

                         <!-- Pregled slika -->
                         <div class="grid grid-cols-2 gap-4">
                             @foreach ($images as $image)

                                 <div class="mb-4">
                                     <img
                                         src="{{ $image->temporaryUrl() }}" alt="Slika uređaja"
                                         class="h-72 max-w-50 rounded"
                                         alt="" />
                                 </div>

                             @endforeach




                         </div>

                         <!-- Akcioni dugmići -->
                         <div class="text-right space-x-2">
                             <button @click="showModal = false" class="btn btn-secondary">Otkaži</button>
                             <button wire:click="finalSubmit" class="btn btn-primary">Potvrdi</button>
                         </div>
                     </div>
                 </div>


             </div>
             </div>







</div>


