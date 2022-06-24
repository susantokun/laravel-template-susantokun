<x-frontend-layout>

    @section('title',__('label.login').' | ')

    <div class="flex w-full min-h-screen bg-slate-100">
        {{-- <div class="flex-col items-center justify-center hidden w-1/2 border lg:flex">left</div> --}}
        <div class="flex flex-col items-center justify-center w-full">
            <div class="flex flex-col items-center justify-center w-full p-0 md:p-8">

                <div class="flex flex-col items-center justify-center mb-4 text-slate-800">
                    <a href="/">
                        <img
                            src="{{ '/storage/'.$configuration->logo_file }}"
                            alt="{{ env('APP_NAME') }}"
                            class="w-24 h-24 sm:w-32 sm:h-32"
                        >
                    </a>
                    <div class="mt-2 text-2xl font-bold">{{ __('label.login_to_your_account') }}</div>
                </div>

                <div class="w-full max-w-md px-10 py-8 border-t rounded-none shadow-none sm:border-t-0 bg-slate-100 sm:bg-white sm:rounded-lg sm:shadow-lg">

                    <!-- Session Status -->
                    <x-auth-session-status
                        class="mb-4"
                        :status="session('status')"
                    />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors
                        class="mb-4"
                        :errors="$errors"
                    />

                    <form
                        method="POST"
                        action="{{ route('login') }}"
                    >
                        @csrf
                        <div>
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
                                autofocus
                            />
                        </div>
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
                                autocomplete="current-password"
                            />
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="">
                                <label
                                    for="remember_me"
                                    class="inline-flex items-center cursor-pointer"
                                >
                                    <input
                                        id="remember_me"
                                        type="checkbox"
                                        class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="remember"
                                    >
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="">
                                @if (Route::has('password.request'))
                                <a
                                    class="text-sm text-gray-600 underline hover:text-gray-900"
                                    href="{{ route('password.request') }}"
                                >
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-center w-full mt-4">
                            <x-button class="inline-flex items-center justify-center w-full">
                                {{ __('label.login') }}
                            </x-button>
                            {{-- <div class="flex items-center justify-center w-full my-4">
                                <div class="w-10 h-px bg-slate-200 grow"></div>
                                <div class="mx-2 text-sm grow-0 text-slate-600">{{ __('label.or_continue_with') }}</div>
                                <div class="w-10 h-px bg-slate-200 grow"></div>
                            </div>
                            <div class="inline-flex items-center justify-center w-full gap-3">
                                <div
                                    class="inline-flex items-center justify-center w-full px-4 py-1 border rounded-md shadow-md cursor-pointer hover:bg-slate-200/80 border-slate-300 bg-slate-200">
                                    <div class="p-1 rounded-full shadow-sm outline-dotted outline-1 bg-slate-100">
                                        <i
                                            class="w-4 h-4 text-slate-600"
                                            data-feather="facebook"
                                        ></i>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center justify-center w-full px-4 py-1 border rounded-md shadow-md cursor-pointer hover:bg-slate-200/80 border-slate-300 bg-slate-200">
                                    <div class="p-1 rounded-full shadow-sm outline-dotted outline-1 bg-slate-100">
                                        <i
                                            class="w-4 h-4 text-slate-600"
                                            data-feather="twitter"
                                        ></i>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center justify-center w-full px-4 py-1 border rounded-md shadow-md cursor-pointer hover:bg-slate-200/80 border-slate-300 bg-slate-200">
                                    <div class="p-1 rounded-full shadow-sm outline-dotted outline-1 bg-slate-100">
                                        <i
                                            class="w-4 h-4 text-slate-600"
                                            data-feather="github"
                                        ></i>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
