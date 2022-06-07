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
    <form
        action="{{ route('accounts.users.store') }}"
        method="post"
    >
        @csrf
        @include('backend.pages.users.form')
    </form>
</x-backend-layout>
