<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Device; 
use App\Models\DeviceImage; 

class SellingRequests extends Component
{
    public $devices;

    public function mount()
    {
        $this->devices = Device::with('images')->get();
    }

    public function render()
    {
        return view('livewire.admin.selling-requests', [
            'devices' => $this->devices
        ])->layout('layouts.admin');
    }
}
