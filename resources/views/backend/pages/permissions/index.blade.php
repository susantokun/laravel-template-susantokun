<x-backend-layout>

    @section('title',__('permission.index_title').' | ')

    <div class="w-full">

        {{-- header content --}}
        <x-header-content title="permission.index">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
                <li class="breadcrumb-item active">{{ __('permission.permission') }}</li>
            </ol>
        </x-header-content>

        <div class="mt-4">
            <div
                id="permission"
                data-roles="{{ auth()->user()->getRoleNames() }}"
                data-can_permissions_delete="{{ $can_permissions_delete }}"
                data-can_permissions_edit="{{ $can_permissions_edit }}"
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
