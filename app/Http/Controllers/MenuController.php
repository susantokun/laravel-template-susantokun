<?php

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

    // public function index(Request $request)
    // {
    //     $roleId = auth()->user()->roles->pluck('id');
    //     $menus = Menu::where('parent_id', 0)->whereIn('role_id', $roleId)->where('status', 1)->with('sub_menu')->has('sub_menu')->orderBy('order', 'asc')->get();

    //     return response([
    //         'menus' => $menus,
    //     ]);
    // }

    public function index(Request $request)
    {
        // $data = Menu::orderBy('created_at', 'desc')->get();

        // $data = Menu::with('sub_menu')->orderBy('id', 'desc')->get();

        // return response()->json([
        //     $menus
        // ]);


        if ($request->ajax()) {
            $data = Menu::with(['parent', 'role'])->orderBy('id', 'desc')->get();

            return response()->json([
                'data' => $data,
            ]);
        }

        $can_menus_delete = auth()->user()->can('menus delete');
        $can_menus_edit = auth()->user()->can('menus edit');

        return view('backend.pages.menus.index', [
            'can_menus_delete' => $can_menus_delete,
            'can_menus_edit' => $can_menus_edit,
        ]);
    }

    public function create()
    {
        if (auth()->user()->getRoleNames()->contains('superadmin')) {
            $roles = Role::pluck('name', 'id')->all();
        } else {
            $roles = Role::where('name', '!=', 'superadmin')->pluck('name', 'id')->all();
        }

        // nanti pake js ketika perannya admin maka kondisi role_id = selected
        $parent = Menu::whereIn('role_id', auth()->user()->roles()->get()->pluck('id', 'id'))->pluck('title', 'id')->all();
        $menuInduk = [ 0 => 'Menu Induk' ];
        $parents = array_merge($menuInduk, $parent);

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
            null
        ));

        return view('backend.pages.menus.create', compact('roles', 'parents', 'routes'));
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
        if (auth()->user()->getRoleNames()->contains('superadmin')) {
            $roles = Role::pluck('name', 'id')->all();
        } else {
            $roles = Role::where('name', '!=', 'superadmin')->pluck('name', 'id')->all();
        }

        // nanti pake js ketika perannya admin maka kondisi role_id = selected
        $parent = Menu::pluck('title', 'id')->all();
        $menuInduk = [ 0 => 'Menu Induk' ];
        $parents = array_merge($menuInduk, $parent);

        return view('backend.pages.menus.edit', compact('menu', 'roles', 'parents'));
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
