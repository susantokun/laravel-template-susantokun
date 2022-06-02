@foreach ($sub_menu as $subMenuKey => $subMenu)
<li>
    <a
        href="{{ !$subMenu['sub_menu']->count() && isset($subMenu['route_name']) ? route($subMenu['route_name'], $subMenu['params']) : 'javascript:;' }}"
        class="{{ $second_level_active_index == $subMenuKey ? 'sidebar_menu sidebar_menu__active' : 'sidebar_menu' }}"
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
                href="{{ !$lastSubMenu['sub_menu']->count() && isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params']) : 'javascript:;' }}"
                class="{{ $third_level_active_index == $lastSubMenuKey ? 'sidebar_menu sidebar_menu__active' : 'sidebar_menu' }}"
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
