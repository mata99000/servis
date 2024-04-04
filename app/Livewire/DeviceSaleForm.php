<?php

namespace App\Livewire;
use Livewire\WithFileUploads;
use App\Models\Device;
use App\Models\DeviceImage;
use Livewire\Component;

class DeviceSaleForm extends Component
{
    use WithFileUploads;
    public $brand, $model, $description, $expected_price ;
    public $name, $address, $postal_code, $city;
    public $showConfirmationModal = false;
    public $images = []; // Promenljiva za više slika

    protected $rules = [
        'name' => 'required',
        'address' => 'required',
        'postal_code' => 'required',
        'city' => 'required',
        'brand' => 'required',
        'model' => 'required',
        'description' => 'required',
        'images.*' => 'image|max:1024|min:1', //
    ];

    public function submit()
    {

        // Logika za čuvanje podataka u bazi

        $this->showConfirmationModal = true; // Prikaži modal za potvrdu
        // Kreiranje instance uređaja i čuvanje u bazi

    }
    public function finalSubmit()
    {
        $device = Device::create([
            'brand' => $this->brand,
            'model' => $this->model,
            'expected_price' => $this->expected_price,

            'description' => $this->description,
        ]);

        // Proveravamo da li je $device uspešno kreiran pre nego što nastavimo
        if ($device) {
            foreach ($this->images as $image) {
                $imagePath = $image->store('public/devices');
                DeviceImage::create([
                    'device_id' => $device->id, // Ovde koristimo $device promenljivu
                    'path' => $imagePath,
                ]);
            }

            session()->flash('message', 'Uređaj je uspešno poslat na otkup sa slikama.');
            $this->reset(['brand', 'model', 'description', 'expected_price', 'images']); // Resetovanje stanja komponente
        } else {
            // U slučaju da postoji problem sa kreiranjem uređaja, obavestite korisnika
            session()->flash('error', 'Došlo je do greške prilikom kreiranja uređaja.');
        }
        $this->reset(); // Resetuj komponentu
        session()->flash('message', 'Vaš zahtev je uspešno poslat.');
    }

    public function render()
    {
        return view('livewire.device-sale-form');
    }
}
