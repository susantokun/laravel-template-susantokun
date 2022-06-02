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
        href="{{ env('APP_URL_ASSET').'/'.$configuration->favicon }}"
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
    @include('backend.layouts.sidebar')
    <div class="flex-1">
        <div class="content">
            @include('backend.layouts.topbar')
            <main>
                {{ $slot }}
            </main>
            @include('backend.layouts.footer')
        </div>
    </div>
</body>

@stack('scripts')

</html>
