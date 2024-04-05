<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Device;
class Dashboard extends Component
{
    public $devices;

    public function mount()
    {
        $this->devices = Device::with('images')->get();
    }
    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.app');
    }
}
