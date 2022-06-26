<x-backend-layout>

    @section('title',__('fileManager.index_title').' | ')

    <div class="w-full">

        {{-- header content --}}
        <x-header-content title="fileManager.index">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ __('label.settings') }}</li>
                <li class="breadcrumb-item active">{{ __('fileManager.fileManager') }}</li>
            </ol>
        </x-header-content>

        <div class="mt-4">
            {{-- <div
                id="file_manager"
                data-can_file_managers_delete="{{ $can_file_managers_delete }}"
                data-can_file_managers_edit="{{ $can_file_managers_edit }}"
            ></div> --}}
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
