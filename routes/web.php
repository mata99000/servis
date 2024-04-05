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
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', App\Livewire\admin\Dashboard::class)->name('admin.dashboard');
});

require __DIR__.'/auth.php';
