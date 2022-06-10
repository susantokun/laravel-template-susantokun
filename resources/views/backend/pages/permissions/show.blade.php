<x-backend-layout>

    @section('title',__('permission.show_title').' | ')

    {{-- header content --}}
    <x-header-content title="permission.show">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.permissions.index') }}">{{ __('permission.permission') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.show') }}</li>
        </ol>
    </x-header-content>

    <div class="show">

        <div class="show_group">
            <x-label class="show_group_label">{{ __('permission.name') }}</x-label>
            <div class="show_group_content">{{ $permission->name }}</div>
        </div>

    </div>
</x-backend-layout>
