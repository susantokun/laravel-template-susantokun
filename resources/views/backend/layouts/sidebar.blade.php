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
                href="{{ !$menu['sub_menu']->count() && isset($menu['route_name']) ? route($menu['route_name']) : 'javascript:;' }}"
                class="{{ $first_level_active_index == $menuKey || request()->routeIs($menu->route_name) ? 'sidebar_menu sidebar_menu__active' : 'sidebar_menu' }}"
            >
                <div class="sidebar_menu__icon">
                    <i data-feather="{{ isset($menu['icon']) ? $menu['icon'] : 'home' }}"></i>
                </div>
                <div class="sidebar_menu__title">
                    {{ $menu['title'] }}
                    @if ($menu['sub_menu']->count())
                    <div
                        class="sidebar_menu__sub_icon {{ $first_level_active_index == $menuKey || request()->routeIs($menu->route_name) ? 'transform rotate-180' : '' }}">
                        <i data-feather="chevron-down"></i>
                    </div>
                    @endif
                </div>
            </a>
            @if ($menu['sub_menu']->count())
            <ul class="{{ $first_level_active_index == $menuKey || request()->routeIs($menu->route_name) ? 'sidebar_menu__sub_open' : '' }}">
                @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                <li>
                    <a
                        href="{{ !$subMenu['sub_menu']->count() && isset($subMenu['route_name']) ? route($subMenu['route_name']) : 'javascript:;' }}"
                        class="{{ ($second_level_active_index == $subMenuKey.'two' && request()->routeIs($subMenu['route_name'])) || request()->routeIs($subMenu->route_group) ? 'sidebar_menu sidebar_menu__active' : 'sidebar_menu' }}"
                    >
                        <div class="sidebar_menu__icon">
                            <i data-feather="{{ isset($subMenu['icon']) ? $subMenu['icon'] : 'corner-down-right' }}"></i>
                        </div>
                        <div class="sidebar_menu__title">
                            {{ $subMenu['title'] }}
                            @if ($subMenu['sub_menu']->count())
                            <div class="sidebar_menu__sub_icon {{ $second_level_active_index == $subMenuKey ? 'transform rotate-180' : '' }}">
                                <i data-feather="chevron-down"></i>
                            </div>
                            @endif
                        </div>
                    </a>
                    @if ($subMenu['sub_menu']->count())
                    <ul class="{{ $second_level_active_index == $subMenuKey ? 'sidebar_menu__sub_open' : '' }}">
                        @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                        <li>
                            <a
                                href="{{ !$lastSubMenu['sub_menu']->count() && isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name']) : 'javascript:;' }}"
                                class="{{ $third_level_active_index == $lastSubMenuKey && request()->routeIs($lastSubMenu['route_name']) ? 'sidebar_menu sidebar_menu__active' : 'sidebar_menu' }}"
                            >
                                <div class="sidebar_menu__icon">
                                    <i data-feather="{{ isset($lastSubMenu['icon']) ? $lastSubMenu['icon'] : 'chevron-right' }}"></i>
                                </div>
                                <div class="sidebar_menu__title">{{ $lastSubMenu['title'] }}</div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
</nav>
