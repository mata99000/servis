<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Device;
use Auth; 
class Dashboard extends Component
{
   
    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.admin');
    }
}
