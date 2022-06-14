<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}"
>

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
        content="Laravel Template for Backend and Frontend by Susantokun"
    />
    <meta
        name="keywords"
        content="laravel, template, template admin, laravel admin, susantokun"
    />
    <meta
        name="author"
        content="Susantokun"
    >

    <link
        rel="shortcut icon"
        href="{{ env('APP_URL_ASSET').'/images/icons/favicon.png' }}"
    />

    <title>@yield('title'){{ env('APP_NAME') }}</title>

    <!-- Styles -->
    <link
        rel="stylesheet"
        href="{{ asset('css/frontend.css') }}"
    >

    <!-- Scripts -->
    <script
        src="{{ asset('js/frontend.js') }}"
        defer
    ></script>
</head>

<body>
    <div class="font-sans antialiased text-gray-900 dark:text-white bg-slate-100 dark:bg-slate-800">
        {{ $slot }}
    </div>
</body>

</html>
