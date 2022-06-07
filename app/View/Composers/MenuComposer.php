<?php

namespace App\View\Composers;

use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!is_null(request()->route())) {
            $pageName = request()->route()->getName();
            $activeMenu = $this->activeMenu($pageName);

            if (auth()->check()) {
                $roleId = auth()->user()->roles->pluck('id');
                $view->with('side_menu', Menu::where('parent_id', 0)
                    ->whereIn('role_id', $roleId)->where('status', 1)->with('sub_menu')->orderBy('order', 'asc')->get());
            } else {
                $view->with('side_menu', null);
            }

            $view->with('first_level_active_index', $activeMenu['first_level_active_index']);
            $view->with('second_level_active_index', $activeMenu['second_level_active_index']);
            $view->with('third_level_active_index', $activeMenu['third_level_active_index']);
            $view->with('page_name', $pageName);
        }
    }

    /**
     * Determine active menu & submenu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activeMenu($pageName)
    {
        $firstLevelActiveIndex = '';
        $secondLevelActiveIndex = '';
        $thirdLevelActiveIndex = '';
        $activeSecond = '';

        if (auth()->check()) {
            $roleId = auth()->user()->roles->pluck('id');
            $menus = Menu::where('parent_id', 0)->whereIn('role_id', $roleId)->where('status', 1)->orderBy('order', 'asc')->get();
        } else {
            $menus = [];
        }

        foreach ($menus as $menuKey => $menu) {
            if (!$menu['sub_menu']->count() > 0 && isset($menu['route_name']) && $menu['route_name'] == $pageName) {
                $firstLevelActiveIndex = $menuKey;
            }

            if ($menus) {
                foreach ($menu['sub_menu'] as $subMenuKey => $subMenu) {
                    if (!$subMenu['sub_menu']->count() > 0 && isset($subMenu['route_name']) && $subMenu['route_name'] == $pageName) {
                        $firstLevelActiveIndex = $menuKey;
                        $secondLevelActiveIndex = $subMenuKey;
                        $activeSecond = 'two';
                    }

                    if (isset($subMenu['sub_menu'])) {
                        foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu) {
                            if (isset($lastSubMenu['route_name']) && $lastSubMenu['route_name'] == $pageName) {
                                $firstLevelActiveIndex = $menuKey;
                                $secondLevelActiveIndex = $subMenuKey;
                                $thirdLevelActiveIndex = $lastSubMenuKey;
                            }
                        }
                    }
                }
            }
        }

        return [
            'first_level_active_index' => $firstLevelActiveIndex,
            'second_level_active_index' => $secondLevelActiveIndex.$activeSecond,
            'third_level_active_index' => $thirdLevelActiveIndex
        ];
    }
}
