<x-backend-layout>

    @section('title','Users | ')

    <div class="w-full">

        {{-- header content --}}
        <x-header-content title="user.index">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
                <li class="breadcrumb-item active">{{ __('user.user') }}</li>
            </ol>
        </x-header-content>

        {{-- <div class="inline-flex items-center justify-between w-full">
            <a href="{{ route('accounts.users.create') }}">
                <x-button-primary>
                    {{ __('label.add_new') }}
                </x-button-primary>
            </a>
        </div> --}}
        <div class="mt-4">
            <div
                id="user"
                data-roles="{{ auth()->user()->getRoleNames() }}"
            ></div>
        </div>

        @if (session()->has('success'))
        <div
            id="notificationDelete"
            data-message="{{ session()->get('success') }}"
            data-status="success"
        ></div>
        @endif
        @if (session()->has('error'))
        <div
            id="notificationDelete"
            data-message="{{ session()->get('error') }}"
            data-status="error"
        ></div>
        @endif

    </div>
</x-backend-layout>
