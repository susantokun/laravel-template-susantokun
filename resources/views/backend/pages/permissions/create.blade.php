<x-backend-layout>

    @section('title',__('permission.create_title').' | ')

    {{-- header content --}}
    <x-header-content title="permission.create">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.permissions.index') }}">{{ __('permission.permission') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.create') }}</li>
        </ol>
    </x-header-content>

    {{-- form create --}}
    {{ Form::open( array( 'route' => ['accounts.permissions.store'], 'permission' => 'form' ) ) }}
    @include('backend.pages.permissions.form')
    {{ Form::close() }}
</x-backend-layout>
