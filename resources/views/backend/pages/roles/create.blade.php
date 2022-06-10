<x-backend-layout>

    @section('title',__('role.create_title').' | ')

    {{-- header content --}}
    <x-header-content title="role.create">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.roles.index') }}">{{ __('role.role') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.create') }}</li>
        </ol>
    </x-header-content>

    {{-- form create --}}
    {{ Form::open( array( 'route' => ['accounts.roles.store'], 'role' => 'form' ) ) }}
    @include('backend.pages.roles.form')
    {{ Form::close() }}
</x-backend-layout>
