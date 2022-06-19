<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : MenuController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Friday, 3rd June 2022 1:29:42 pm
 * | Last Modified   : Sunday, 19th June 2022 5:54:54 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menus view', ['only' => ['index', 'show']]);
        $this->middleware('permission:menus create', ['only' => ['create', 'store']]);
        $this->middleware('permission:menus edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menus delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $can_menus_delete = auth()->user()->can('menus delete');
        $can_menus_edit = auth()->user()->can('menus edit');

        return view('backend.pages.menus.index', [
            'can_menus_delete' => $can_menus_delete,
            'can_menus_edit' => $can_menus_edit,
        ]);
    }

    public function create()
    {
        $routeCollection = Route::getRoutes();
        $routes = [];
        foreach ($routeCollection as $key => $value) {
            if ($value->methods()[0] == 'GET') {
                $routes[$value->getName()] = $value->getName();
            }
        }
        $routes = Arr::except($routes, array(
            'ignition.healthCheck',
            'ignition.executeSolution',
            'ignition.updateConfig',
            'register',
            'login',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'verification.notice',
            'verification.verify',
            'verification.send',
            'password.confirm',
            'logout',
            'verify',
            'api.users.index',
            'api.roles.index',
            'api.menus.index',
            'api.menus.select',
            null
        ));

        return view('backend.pages.menus.create', compact( 'routes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'parent_id' => 'required',
            'title' => 'required',
            'route_name' => 'nullable',
            'route_group' => 'nullable',
            'icon' => 'nullable',
            'order' => 'nullable',
            'status' => 'required',
        ]);

        $input = $request->all();

        if (empty($input['order']) || empty($input['icon'])) {
            $input['order'] = 0;
            $input['icon'] = NULL;
        }

        Menu::create($input);

        return redirect()->route('settings.menus.index')->with('success', __('menu.store_success'));
    }

    public function show($id)
    {
        $menu = Menu::with(['role', 'parent'])->find($id);

        return view('backend.pages.menus.show', compact('menu'));
    }

    public function edit($id)
    {
        $menu = Menu::find($id);

        $routeCollection = Route::getRoutes();
        $routes = [];
        foreach ($routeCollection as $key => $value) {
            if ($value->methods()[0] == 'GET') {
                $routes[$value->getName()] = $value->getName();
            }
        }
        $routes = Arr::except($routes, array(
            'ignition.healthCheck',
            'ignition.executeSolution',
            'ignition.updateConfig',
            'register',
            'login',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'verification.notice',
            'verification.verify',
            'verification.send',
            'password.confirm',
            'logout',
            'verify',
            'api.users.index',
            'api.roles.index',
            'api.menus.index',
            'api.menus.select',
            null
        ));

        return view('backend.pages.menus.edit', compact('menu', 'routes'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'parent_id' => 'required',
            'title' => 'required',
            'route_name' => 'nullable',
            'route_group' => 'nullable',
            'icon' => 'nullable',
            'order' => 'nullable',
            'status' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $input = $request->all();

        if (empty($input['order']) || empty($input['icon'])) {
            $input['order'] = 0;
            $input['icon'] = NULL;
        }

        $menu->update($input);

        return redirect()->route('settings.menus.index')->with('success', __('menu.update_success'));
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);

        $menu->delete();
        return response()->json([
            'status'  => true,
            'message' => __('menu.destroy_success'),
        ]);
    }

}
