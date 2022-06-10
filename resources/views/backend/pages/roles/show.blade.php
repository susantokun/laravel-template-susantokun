<x-backend-layout>

    @section('title',__('role.show_title').' | ')

    {{-- header content --}}
    <x-header-content title="role.show">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.roles.index') }}">{{ __('role.role') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.show') }}</li>
        </ol>
    </x-header-content>

    <div class="show">

        <div class="show_group">
            <x-label class="show_group_label">{{ __('role.name') }}</x-label>
            <div class="show_group_content">{{ $role->name }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('role.roles') }}</x-label>
            <div class="show_group_content">
                @if(!empty($rolePermissions))
                @if($rolePermissions->count() <> 1)
                <div class="list-inside list-desc">
                    @foreach ($rolePermissions as $item)
                    <div class="list-item">{{ $item->name }}</div>
                    @endforeach
                </div>
                @else
                {{ $rolePermissions[0]['name'] }}
                @endif
                @endif
            </div>
        </div>

    </div>
</x-backend-layout>
