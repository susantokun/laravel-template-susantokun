<x-frontend-layout>

    @section('head')
    <title>Laravel Template Susantokun</title>
    @endsection

    <div class="flex flex-col items-center justify-center min-h-screen px-4 mx-auto leading-8 text-center select-none max-w-7xl sm:px-6 lg:px-8">
        <div class="font-mono">Welcome to <span class="underline decoration-sky-500 underline-offset-2">Laravel</span> <span
                class="underline decoration-pink-500 underline-offset-2"
            >Template</span>
            <span class="underline decoration-indigo-500 underline-offset-2">Susantokun</span> (<span class="font-bold">LTS</span>)
        </div>
        <div class="">
            @if (Route::has('login'))
            <div class="top-0 right-0 items-center justify-center hidden gap-2 px-6 py-4 sm:inline-flex">
                @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="text-sm text-gray-200 dark:text-gray-100 px-4 py-1.5 bg-primary rounded-md shadow-md shadow-primary/60"
                >Dashboard</a>
                @else
                <a href="{{ route('login') }}">
                    <x-button-primary>
                        Log in
                    </x-button-primary>
                </a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">
                    <x-button-secondary>
                        Register
                    </x-button-secondary>
                </a>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </div>
</x-frontend-layout>
