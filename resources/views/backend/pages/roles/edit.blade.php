<x-backend-layout>

    @section('title',__('role.edit_title').' | ')

    {{-- header content --}}
    <x-header-content title="role.edit">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.roles.index') }}">{{ __('role.role') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.edit') }}</li>
        </ol>
    </x-header-content>

    {{-- form edit --}}
    {{ Form::model( $role, ['route' => ['accounts.roles.update', $role->id], 'method' => 'PUT', 'role' => 'form'] ) }}
    @include('backend.pages.roles.form')
    {{ Form::close() }}
</x-backend-layout>
