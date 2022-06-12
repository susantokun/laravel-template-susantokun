<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="description"
        content="{{ $configuration->desc }}"
    />
    <meta
        name="keywords"
        content="{{ $configuration->keywords }}"
    />
    <meta
        name="author"
        content="{{ $configuration->author }}"
    >

    <link
        rel="shortcut icon"
        href="{{ '/storage/'.$configuration->favicon_file }}"
    />

    <title>@yield('title'){{ env('APP_NAME') }}</title>

    <!-- Styles -->
    <link
        rel="stylesheet"
        href="{{ asset('css/backend.css') }}"
    >
    @stack('styles')

    <!-- Scripts -->
    <script
        src="{{ asset('js/backend.js') }}"
        defer
    ></script>
</head>

<body>
    <div class="flex flex-col min-h-screen p-3 md:flex-row md:p-5">

        @include('backend.layouts.sidebar')
        @include('backend.layouts.mobile-menu')
        <div class="flex flex-1 w-full pl-0 overflow-x-hidden md:pl-5">
            <div class="content">
                <div class="flex-1">
                    @include('backend.layouts.topbar')
                    <main>
                        {{ $slot }}
                    </main>
                </div>
                @include('backend.layouts.footer')
            </div>
        </div>
    </div>
    {{-- @include('sweetalert::alert') --}}
    @stack('scripts')
</body>

</html>
