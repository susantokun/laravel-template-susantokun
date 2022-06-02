<nav class="sidebar">
    <a
        href="{{ route('dashboard') }}"
        class="flex items-center py-5 pl-5 h-[70px] te-x"
    >
        <img
            alt="Laravel Template Susantokun"
            class="w-6"
            src="{{ env('APP_URL_ASSET').'/'.$configuration->logo_file }}"
        >
        <span class="hidden ml-3 text-lg text-white sidebar__title xl:block">
            {{ $configuration->title_short }}
        </span>
    </a>

    <div class="mb-6 sidebar__devider"></div>
    <ul class="navigation">
        @foreach ($side_menu as $menuKey => $menu)
        <li>
            <a
                href="{{ !$menu['sub_menu']->count() && isset($menu['route_name']) ? route($menu['route_name'], $menu['params']) : 'javascript:;' }}"
                class="{{ $first_level_active_index == $menuKey ? 'sidebar_menu sidebar_menu__active' : 'sidebar_menu' }}"
            >
                <div class="sidebar_menu__icon">
                    <i data-feather="{{ isset($menu['icon']) ? $menu['icon'] : 'home' }}"></i>
                </div>
                <div class="sidebar_menu__title">
                    {{ $menu['title'] }}
                    @if ($menu['sub_menu']->count())
                    <div class="sidebar_menu__sub_icon {{ $first_level_active_index == $menuKey ? 'transform rotate-180' : '' }}">
                        <i data-feather="chevron-down"></i>
                    </div>
                    @endif
                </div>
            </a>
            @if ($menu['sub_menu']->count())
            <ul class="{{ $first_level_active_index == $menuKey ? 'sidebar_menu__sub_open' : '' }}">
                @include('backend.components.menu',['sub_menu' => $menu['sub_menu']])
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
</nav>
