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
