<?php

namespace App\Livewire;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

use App\Models\Device;
use App\Models\DeviceImage;
use Livewire\Component;

class DeviceSaleForm extends Component
{
    use WithFileUploads;
    protected $layout = 'layouts.app';
    public $brand, $model, $description, $expected_price ;
    public $name, $address, $postal_code, $city;
    public $showConfirmationModal = false;
    public $images = []; // Promenljiva za više slika
    public $progress;



    public function submit()
    {       

        // Logika za čuvanje podataka u bazi
       // $this->validate([
        //'brand' => 'required|string|max:255',
       // 'model' => 'required|string|max:255',
       ///'expected_price' => 'required|numeric',
        //'description' => 'required|string',
        //'images' => $this->temporary_file_upload['rules'], // Proverava da li je niz slika prazan
        //'images.*' => 'required|image|max:20048', // Dozvolite samo slike do 10MB
   // ]); 
   $this->validate([
    'brand' => 'required',
    'model' => 'required',
    'expected_price' => 'required|numeric',
    'description' => 'nullable|string',
    'images.*' => 'image|max:2048', // 2MB max po slici
]);

    $device = Device::create([
        'brand' => $this->brand,
        'model' => $this->model,
        'expected_price' => $this->expected_price,
        'description' => $this->description,
    ]);

    // Proveravamo da li je $device uspešno kreiran pre nego što nastavimo
    if ($device) {
        foreach ($this->images as $image) {
            $name = $image->hashName(); // Dohvati ime slike
            $imagePath = $image->storeAs('device_images',$name ,'public'); // Učitaj sliku u folder device_images            
            DeviceImage::create([
                'device_id' => $device->id, // Ovde koristimo $device promenljivu
                'path' => $imagePath,
            ]);
        }

        $this->reset(['brand', 'model', 'description', 'expected_price', 'images']); 
        } else {
        // U slučaju da postoji problem sa kreiranjem uređaja, obavestite korisnika
        session()->flash('error', 'Došlo je do greške prilikom kreiranja uređaja.');

    }
    $this->reset(); // Resetuj komponentu
    session()->flash('message', 'Vaš zahtev je uspešno poslat.');
    


    }
    
    
    
public function removeImage($index)
{
    unset($this->images[$index]);
    $this->images = array_values($this->images); // Resetujemo indekse niza
    $this->dispatch('reset-input');
}

    public function render()
    {
        return view('livewire.device-sale-form')->layout('layouts.app');
    }
}
