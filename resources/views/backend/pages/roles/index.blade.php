<x-backend-layout>

    @section('title',__('role.index_title').' | ')

    <div class="w-full">

        {{-- header content --}}
        <x-header-content title="role.index">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
                <li class="breadcrumb-item active">{{ __('role.role') }}</li>
            </ol>
        </x-header-content>

        <div class="mt-4">
            <div
                id="role"
                data-roles="{{ auth()->user()->getRoleNames() }}"
                data-can_roles_delete="{{ $can_roles_delete }}"
                data-can_roles_edit="{{ $can_roles_edit }}"
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
