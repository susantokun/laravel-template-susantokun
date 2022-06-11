<x-backend-layout>

    @section('title',__('user.create_title').' | ')

    {{-- header content --}}
    <x-header-content title="user.create">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.users.index') }}">{{ __('user.user') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.create') }}</li>
        </ol>
    </x-header-content>

    {{-- form create --}}
    {{ Form::open( array( 'route' => ['accounts.users.store'], 'enctype' => 'multipart/form-data' ) ) }}
    @include('backend.pages.users.form')
    {{ Form::close() }}
</x-backend-layout>
