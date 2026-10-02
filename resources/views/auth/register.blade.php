<x-guest-layout>
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <form method="POST" action="{{ route('register') }}">
        @csrf

      
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="block mt-1 w-full"
                :value="old('name')"
                required
                autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

     
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="block mt-1 w-full"
                :value="old('email')"
                required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input
                id="phone"
                name="phone"
                type="text"
                class="block mt-1 w-full"
                :value="old('phone')"
                required
                autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input
                id="address"
                name="address"
                type="text"
                class="block mt-1 w-full"
                :value="old('address')"
                required
                autocomplete="street-address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        {{-- <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register As')" />

            <select
                id="role"
                name="role"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                required>

                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
                <option value="admin">Administrator</option>

            </select>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div> --}}

        
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="block mt-1 w-full"
                required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label
                for="password_confirmation"
                :value="__('Confirm Password')" />

            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="block mt-1 w-full"
                required
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">

            <a
                href="{{ route('login') }}"
                class="underline text-sm text-gray-600">

                Already registered?

            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>