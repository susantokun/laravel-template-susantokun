<!-- BEGIN: Mobile Menu -->
<div class="mobile_menu md:hidden">
    <div class="mobile_menu_bar">
        <a
            href="{{ route('dashboard') }}"
            class="flex mr-auto"
        >
            <img
                alt="Laravel Template Susantokun"
                class="w-6"
                src="{{ env('APP_URL_ASSET').'/'.$configuration->logo_file }}"
            >
            <span class="block ml-3 text-lg text-white menu__title">
                {{ $configuration->title_short }}
            </span>
        </a>
        <a
            href="javascript:;"
            id="mobile_menu_toggler"
        >
            <i
                data-feather="bar-chart-2"
                class="w-8 h-8 text-white transform -rotate-90"
            ></i>
        </a>
    </div>
    <ul class="border-t border-white/[0.08] py-5 hidden">
        @foreach ($side_menu as $menuKey => $menu)
        <li>
            <a
                href="{{ !$menu['sub_menu']->count() && isset($menu['route_name']) ? route($menu['route_name']) : 'javascript:;' }}"
                class="{{ $first_level_active_index == $menuKey && request()->routeIs($menu['route_name']) ? 'menu menu__active' : 'menu' }}"
            >
                <div class="menu__icon">
                    <i data-feather="{{ isset($menu['icon']) ? $menu['icon'] : 'home' }}"></i>
                </div>
                <div class="menu__title">
                    {{ $menu['title'] }}
                    @if ($menu['sub_menu']->count())
                    <div class="menu__sub_icon {{ $first_level_active_index == $menuKey ? 'transform rotate-180' : '' }}">
                        <i data-feather="chevron-down"></i>
                    </div>
                    @endif
                </div>
            </a>
            @if ($menu['sub_menu']->count())
            <ul class="{{ $first_level_active_index == $menuKey ? 'menu__sub_open' : '' }}">
                @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                <li>
                    <a
                        href="{{ !$subMenu['sub_menu']->count() && isset($subMenu['route_name']) ? route($subMenu['route_name'], $subMenu['params']) : 'javascript:;' }}"
                        class="{{ $second_level_active_index == $subMenuKey.'two' && request()->routeIs($subMenu['route_name']) ? 'menu menu__active' : 'menu' }}"
                    >
                        <div class="menu__icon">
                            <i data-feather="{{ isset($subMenu['icon']) ? $subMenu['icon'] : 'corner-down-right' }}"></i>
                        </div>
                        <div class="menu__title">
                            {{ $subMenu['title'] }}
                            @if ($subMenu['sub_menu']->count())
                            <div class="menu__sub_icon {{ $second_level_active_index == $subMenuKey ? 'transform rotate-180' : '' }}">
                                <i data-feather="chevron-down"></i>
                            </div>
                            @endif
                        </div>
                    </a>
                    @if ($subMenu['sub_menu']->count())
                    <ul class="{{ $second_level_active_index == $subMenuKey ? 'menu__sub_open' : '' }}">
                        @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                        <li>
                            <a
                                href="{{ !$lastSubMenu['sub_menu']->count() && isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params']) : 'javascript:;' }}"
                                class="{{ $third_level_active_index == $lastSubMenuKey && request()->routeIs($lastSubMenu['route_name']) ? 'menu menu__active' : 'menu' }}"
                            >
                                <div class="menu__icon">
                                    <i data-feather="{{ isset($lastSubMenu['icon']) ? $lastSubMenu['icon'] : 'chevron-right' }}"></i>
                                </div>
                                <div class="menu__title">{{ $lastSubMenu['title'] }}</div>
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
</div>
<!-- END: Mobile Menu -->
