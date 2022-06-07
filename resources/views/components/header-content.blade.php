@props(['title'])
{{-- <div class="flex items-center h-10 intro-y">
    <h2 class="mr-5 text-lg font-medium truncate">{{ $title }}</h2>
    {{ $slot }}
</div> --}}

<div class="flex flex-col justify-between px-1 sm:flex-row">
    <div class="text-center sm:text-left flex-start">
        <h3 class="text-lg font-semibold leading-6 text-gray-800 dark:text-gray-200">{{ __($title.'_title') }}</h3>
        <p class="mt-px text-sm leading-5 text-gray-600 dark:text-gray-400 sm:mt-1">{{ __($title.'_desc') }}</p>
    </div>
    <div class="flex items-end justify-center mt-2 sm:mt-0">
        <nav
            aria-label="breadcrumb"
            class="flex items-center justify-center px-3 py-1 rounded-md sm:px-0 sm:py-0 sm:rounded-none -intro-x bg-secondary sm:bg-transparent"
        >
            {{-- <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ __('label.').$home }}</li>
                <li class="breadcrumb-item"><a href="{{ route('accounts.users.index') }}">{{ __('user.user') }}</a></li>
                <li class="breadcrumb-item active">{{ __('label.create') }}</li>
            </ol> --}}
            {{ $slot }}
        </nav>
    </div>
</div>
<div class="pb-4 border-b border-dashed border-primary/60"></div>
