<x-backend-layout>

    @section('title',__('menu.edit_title').' | ')

    {{-- header content --}}
    <x-header-content title="menu.edit">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.settings') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('settings.menus.index') }}">{{ __('menu.menu') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.edit') }}</li>
        </ol>
    </x-header-content>

    {{-- form edit --}}
    {{ Form::model( $menu, ['route' => ['settings.menus.update', $menu->id], 'method' => 'PUT', 'menu' => 'form'] ) }}
    @include('backend.pages.menus.form')
    {{ Form::close() }}
</x-backend-layout>
