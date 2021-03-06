<?php

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : RoleController.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Friday, 3rd June 2022 1:29:42 pm
 * | Last Modified   : Sunday, 19th June 2022 5:55:57 pm
 * | HISTORY         :
 * |==============================================================|
 */

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles view', ['only' => ['index', 'show']]);
        $this->middleware('permission:roles create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $can_roles_delete = auth()->user()->can('roles delete');
        $can_roles_edit = auth()->user()->can('roles edit');

        return view('backend.pages.roles.index', [
            'can_roles_delete' => $can_roles_delete,
            'can_roles_edit' => $can_roles_edit,
        ]);
    }

    public function create()
    {
        if (!auth()->user()->getRoleNames()->contains('superadmin')) {
            $permissions = Permission::whereNotIn('name', [
                'roles delete',
                'roles view superadmin',
                'permissions view',
                'permissions create',
                'permissions edit',
                'permissions delete',
                'configurations delete',
                'users view superadmin',
                'users import',
                'users export',
                'users download',
                'menus view',
                'menus create',
                'menus edit',
                'menus delete',
                'file managers view',
                'file managers create',
                'file managers edit',
                'file managers delete',
            ])->get();
        } else {
            $permissions = Permission::get();
        }

        return view('backend.pages.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            // 'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('accounts.roles.index')
            ->with('success', __('role.store_success'));
    }

    public function show($id)
    {
        $auth_can_roles_view_superadmin = auth()->user()->can('roles view superadmin');
        $user_can_roles_view_superadmin = Role::find($id)->getPermissionNames()->contains('roles view superadmin');
        $superadmin = auth()->user()->getRoleNames()->contains('superadmin');
        $admin = auth()->user()->getRoleNames()->contains('admin');

        if (($user_can_roles_view_superadmin && $superadmin) || $auth_can_roles_view_superadmin) {
            $role = Role::find($id);
        } else if (!$user_can_roles_view_superadmin && ($admin || $superadmin) || $auth_can_roles_view_superadmin) {
            $role = Role::find($id);
        } else {
            abort(401);
        }

        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('backend.pages.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        if (!auth()->user()->getRoleNames()->contains('superadmin')) {
            $permissions = Permission::whereNotIn('name', [
                'roles delete',
                'roles view superadmin',
                'permissions view',
                'permissions create',
                'permissions edit',
                'permissions delete',
                'configurations delete',
                'users view superadmin',
                'users import',
                'users export',
                'users download',
                'menus view',
                'menus create',
                'menus edit',
                'menus delete',
                'file managers view',
                'file managers create',
                'file managers edit',
                'file managers delete',
            ])->get();
        } else {
            $permissions = Permission::get();
        }
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('backend.pages.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'permissions' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('accounts.roles.index')
            ->with('success', __('role.update_success'));
    }

    public function destroy($id)
    {
        $menu = Menu::where('role_id', $id);
        $menu->delete();

        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json([
            'status'  => true,
            'message' => __('role.destroy_success'),
        ]);
    }
}
