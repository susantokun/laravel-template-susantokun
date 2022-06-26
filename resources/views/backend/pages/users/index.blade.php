<x-backend-layout>

    @section('title',__('user.index_title').' | ')

    <div class="w-full">

        {{-- header content --}}
        <x-header-content title="user.index">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
                <li class="breadcrumb-item active">{{ __('user.user') }}</li>
            </ol>
        </x-header-content>

        <div class="mt-4">
            <div
                id="user"
                data-auth="{{ auth()->user() }}"
                data-can_users_delete="{{ $can_users_delete }}"
                data-can_users_edit="{{ $can_users_edit }}"
                data-can_users_import="{{ $can_users_import }}"
                data-can_users_export="{{ $can_users_export }}"
                data-can_users_download="{{ $can_users_download }}"
            ></div>
        </div>

        @if (session()->has('success'))
        <div
            id="notification"
            data-message="{{ session()->get('success') }}"
            data-status="success"
        ></div>
        @endif
        @if (session()->has('error'))
        <div
            id="notification"
            data-message="{{ session()->get('error') }}"
            data-status="error"
        ></div>
        @endif

    </div>
</x-backend-layout>
