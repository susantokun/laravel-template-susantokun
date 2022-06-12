<x-backend-layout>

    @section('title',__('menu.index_title').' | ')

    <div class="w-full">

        {{-- header content --}}
        <x-header-content title="menu.index">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ __('label.settings') }}</li>
                <li class="breadcrumb-item active">{{ __('menu.menu') }}</li>
            </ol>
        </x-header-content>

        <div class="mt-4">
            <div
                id="menu"
                data-roles="{{ auth()->user()->getRoleNames() }}"
                data-can_menus_delete="{{ $can_menus_delete }}"
                data-can_menus_edit="{{ $can_menus_edit }}"
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
