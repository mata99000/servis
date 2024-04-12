<!-- Layout File: layout.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Service</title>
       @vite(['resources/css/app.css', 'resources/js/app.js'])
       <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


</head>
<body class="bg-indigo-950 text-gray-900">
<!-- Alpine.js za dinamički JavaScript framework -->
<!-- Alpine.js za dinamički JavaScript framework -->

<header class="bg-gray-900 shadow" x-data="{ open: false, openAccount: false }">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white" style="font-family: 'Roboto', sans-serif;">
        <a href="/" wire:navigate='/'>Device Service</a>
        </h1>
        <!-- Hamburger Button -->
        <button @click="open = !open" class="text-gray-200 hover:text-gray-100 focus:outline-none sm:hidden">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <!-- Regular Links for large screens -->
        <nav class="hidden sm:flex space-x-4">
            <a href="/sell" wire:navigate='/sell' class="text-gray-200 font-semibold hover:text-gray-100">Sell Your Device</a>
            <a href="/create-repair-request" class="text-gray-200 font-semibold hover:text-gray-100">Create Repair Request</a>
            <div @click.away="openAccount = false" class="relative" x-data="{ openAccount: false }">
                <button @click="openAccount = !openAccount" class="text-gray-200 font-semibold hover:text-gray-100 flex items-center space-x-2">
                    <span>Account</span>
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4">
                        <path d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openAccount" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                    <a href="/profile" wire:navigate='/profile' class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                    <a href="/logout "wire:navigate='/logout' class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </nav>
        <!-- Side Navigation Menu -->
        <div class="absolute top-0 left-0 w-64 h-full bg-gray-900 transform -translate-x-full transition-transform duration-300 ease-in-out"
             :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
             @click.away="open = false"
             x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <nav class="flex flex-col items-start p-4 space-y-3">
                <a href="/sell" wire:navigate='/sell' class="text-gray-200 font-semibold hover:text-gray-100">Sell Your Device</a>
                <a href="/create-repair-request" class="text-gray-200 font-semibold hover:text-gray-100">Create Repair Request</a>
                <div @click.away="openAccount = false" class="relative" x-data="{ openAccount: false }">
                    <button @click="openAccount = !openAccount" class="text-gray-200 font-semibold hover:text-gray-100 flex items-center space-x-2 w-full text-left">
                        <span>Account</span>
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openAccount" class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                        <a href="/profile" wire:navigate='/profile' class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="/settings" wire:navigate='/settings' class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                        <a href="/logout" wire:navigate='/logout' class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>



    <main>
    {{$slot}}
    </main>
    <footer class="bg-white shadow mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-700 text-sm">
                &copy; 2024 Device Service. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
