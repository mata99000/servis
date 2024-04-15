<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $address = '';
    public string $postal_code = '';
    public string $city = '';

    public string $email = '';

    /**
     * Mount the component.
     */
   public function mount(): void
{
    $user = Auth::user();  // Definisati ovu promenljivu pravilno
    $this->name = $user->name;
    $this->address = $user->address ?? '';
    $this->postal_code = $user->postal_code ?? '';
    $this->city = $user->city ?? '';
    $this->email = $user->email;
}

    

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {

     $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore(Auth::user()->id)],
        'address' => ['required', 'string', 'max:255'],
        'postal_code' => ['required', 'numeric'],
        'city' => ['required', 'string', 'max:255'],
    ]);

    $user = Auth::user();
    $user->update([
        'name' => $this->name,
        'email' => $this->email,
        'address' => $this->address,
        'postal_code' => $this->postal_code,
        'city' => $this->city,
    ]);

    $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
          <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="address" id="address" name="address" type="text" class="mt-1 block w-full" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>
          <div>
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input wire:model="postal_code" id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" required autofocus autocomplete="postal_code" />
            <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
        </div>
          <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input wire:model="city" id="city" name="city" type="text" class="mt-1 block w-full" required autofocus autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
