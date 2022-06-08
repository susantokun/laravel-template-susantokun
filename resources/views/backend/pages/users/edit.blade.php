<x-backend-layout>

    @section('title',__('user.edit_title').' | ')

    {{-- header content --}}
    <x-header-content title="user.edit">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.accounts') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('accounts.users.index') }}">{{ __('user.user') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.edit') }}</li>
        </ol>
    </x-header-content>

    {{-- form edit --}}
    {{ Form::model( $user, ['route' => ['accounts.users.update', $user->id], 'method' => 'PUT', 'role' => 'form'] ) }}
    @include('backend.pages.users.form')
    {{ Form::close() }}
</x-backend-layout>
