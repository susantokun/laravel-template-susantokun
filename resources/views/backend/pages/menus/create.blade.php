<x-backend-layout>

    @section('title',__('menu.create_title').' | ')

    {{-- header content --}}
    <x-header-content title="menu.create">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.settings') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('settings.menus.index') }}">{{ __('menu.menu') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.create') }}</li>
        </ol>
    </x-header-content>

    {{-- form create --}}
    {{ Form::open( array( 'route' => ['settings.menus.store'], 'menu' => 'form' ) ) }}
    @include('backend.pages.menus.form')
    {{ Form::close() }}
</x-backend-layout>
