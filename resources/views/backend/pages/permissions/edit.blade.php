<x-backend-layout>

    @section('title',__('permission.edit_title').' | ')

    {{-- header content --}}
    <x-header-content title="permission.edit">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.permissions.index') }}">{{ __('permission.permission') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.edit') }}</li>
        </ol>
    </x-header-content>

    {{-- form edit --}}
    {{ Form::model( $permission, ['route' => ['accounts.permissions.update', $permission->id], 'method' => 'PUT', 'permission' => 'form'] ) }}
    @include('backend.pages.permissions.form')
    {{ Form::close() }}
</x-backend-layout>
