<x-frontend-layout>

    @section('title',__('label.register').' | ')

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors
            class="mb-4"
            :errors="$errors"
        />

        <form
            method="POST"
            action="{{ route('register') }}"
        >
            @csrf

            <!-- First Name -->
            <div>
                <x-label
                    for="first_name"
                    :value="__('First Name')"
                />

                <x-input
                    id="first_name"
                    class="block w-full mt-1"
                    type="text"
                    name="first_name"
                    :value="old('first_name')"
                    required
                    autofocus
                />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label
                    for="last_name"
                    :value="__('Last Name')"
                />

                <x-input
                    id="last_name"
                    class="block w-full mt-1"
                    type="text"
                    name="last_name"
                    :value="old('last_name')"
                    required
                    autofocus
                />
            </div>

            <!-- Full Name -->
            <div class="mt-4">
                <x-label
                    for="full_name"
                    :value="__('Full Name')"
                />

                <x-input
                    id="full_name"
                    class="block w-full mt-1"
                    type="text"
                    name="full_name"
                    :value="old('full_name')"
                    required
                    autofocus
                />
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-label
                    for="username"
                    :value="__('Username')"
                />

                <x-input
                    id="username"
                    class="block w-full mt-1"
                    type="text"
                    name="username"
                    :value="old('username')"
                    required
                    autofocus
                />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label
                    for="email"
                    :value="__('Email')"
                />

                <x-input
                    id="email"
                    class="block w-full mt-1"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label
                    for="password"
                    :value="__('Password')"
                />

                <x-input
                    id="password"
                    class="block w-full mt-1"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label
                    for="password_confirmation"
                    :value="__('Confirm Password')"
                />

                <x-input
                    id="password_confirmation"
                    class="block w-full mt-1"
                    type="password"
                    name="password_confirmation"
                    required
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a
                    class="text-sm text-gray-600 underline hover:text-gray-900"
                    href="{{ route('login') }}"
                >
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-frontend-layout>
