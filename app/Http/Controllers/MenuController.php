<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user()->roles->pluck('id');
        $menus = Menu::where('parent_id', 0)->where('role_id', $user)->where('status', 1)->get();

        return response([
            'menus' => $menus,
        ]);
    }
}
