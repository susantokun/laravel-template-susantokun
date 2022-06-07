<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $roleId = auth()->user()->roles->pluck('id');
        $menus = Menu::where('parent_id', 0)->whereIn('role_id', $roleId)->where('status', 1)->with('sub_menu')->has('sub_menu')->orderBy('order', 'asc')->get();

        return response([
            'menus' => $menus,
        ]);
    }
}
