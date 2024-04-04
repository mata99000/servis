<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\DeviceSaleForm;
Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/sell', App\Livewire\DeviceSaleForm::class)->name('sell');

require __DIR__.'/auth.php';
