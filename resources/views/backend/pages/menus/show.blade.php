<x-backend-layout>

    @section('title',__('menu.show_title').' | ')

    {{-- header content --}}
    <x-header-content title="menu.show">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('label.settings') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('settings.menus.index') }}">{{ __('menu.menu') }}</a></li>
            <li class="breadcrumb-item active">{{ __('label.show') }}</li>
        </ol>
    </x-header-content>

    <div class="show">

        <div class="show_group">
            <x-label class="show_group_label">{{ __('menu.title') }}</x-label>
            <div class="show_group_content">{{ $menu->title }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('menu.role_id') }}</x-label>
            <div class="show_group_content">{{ $menu->role->name }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('menu.parent_id') }}</x-label>
            <div class="show_group_content">{{ isset($menu->parent->title) ? $menu->parent->title : '-' }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('menu.route_name') }}</x-label>
            <div class="show_group_content">{{ $menu->route_name }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('menu.route_group') }}</x-label>
            <div class="show_group_content">{{ $menu->route_group }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('menu.icon') }}</x-label>
            <div class="show_group_content">{{ $menu->icon }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('menu.order') }}</x-label>
            <div class="show_group_content">{{ $menu->order }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('menu.status') }}</x-label>
            <div class="show_group_content">{{ $menu->status }}</div>
        </div>

        <div class="show_group">
            <x-label class="show_group_label">{{ __('label.created_at') }}</x-label>
            <div class="show_group_content">{{ \Carbon\Carbon::parse($menu->created_at)->isoFormat('dddd, Do MMMM YYYY hh:mm a') }}</div>
        </div>
        <div class="show_group">
            <x-label class="show_group_label">{{ __('label.updated_at') }}</x-label>
            <div class="show_group_content">{{ \Carbon\Carbon::parse($menu->updated_at)->isoFormat('dddd, Do MMMM YYYY hh:mm a') }}</div>
        </div>

    </div>
</x-backend-layout>
